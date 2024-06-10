<?php

namespace App\Jobs\Dashboard\Order;

use App\Http\Requests\Dashboard\Order\Update as UpdateRequest;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Illuminate\Support\Facades\Http;


class Products
{
    protected $order;
    protected $request;

    public function __construct(Order $order, UpdateRequest $request)
    {
        $this->order = $order;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $replacements = [];
        if ($this->request->has('deletes')) { // delete product
            foreach ($this->request->deletes as $delete) {
                $order_product = OrderProducts::where('order_id', $this->order->id)->where('product_id', $delete)->first();
                $region = $order_product->product->regions()->where('id', '=', $this->request->region_id)->first();
                $region->pivot->count += $order_product->count;
                $region->pivot->save();
                $replacements['delete'][] = ['id' => (int)$delete];
            }
        }

        foreach ($this->request->getProducts() as $product) {
            $order_product = OrderProducts::where('product_id', $product['product_id'])->where('order_id', $this->order->id)->first();
            if (isset($order_product) and $order_product->count != $product['count']) { // update products count
                $replacements['edit'][] = [
                    'id' => (int)$order_product->product_id,
                    'qty' => (int)$product['count']
                ];

                $region = $order_product->product->regions()->where('id', '=', $this->request->region_id)->first();

                if ($order_product->count < $product['count']) {
                    $count = $product['count'] - $order_product->count;
                    $region->pivot->count -= $count;
                }
                elseif ($order_product->count > $product['count']) {
                    $count = $order_product->count - $product['count'];
                    $region->pivot->count += $count;
                }
                $region->pivot->save();
            }
            if (empty($order_product)) { // add new product
                $region = Product::find($product['product_id'])->regions()->where('id', '=', $this->request->region_id)->first();
                $region->pivot->count -= $product['count'];
                $region->pivot->save();
                $replacements['create'][] = [
                    'id' => (int)$product['product_id'],
                    'qty' => (int)$product['count']
                ];
            }
        }
        OrderProducts::where('order_id', $this->order->id)->delete();

        foreach ($this->request->getProducts() as $product) {
            OrderProducts::create([
                'color_id' => $product['color_id'],
                'order_id' => $this->order->id,
                'size' => $product['size'],
                'product_id' => $product['product_id'],
                'count' => $product['count'],
                'price' => $product['product']['price_discount'] ? $product['product']['price_discount'] : $product['product']['price'],
                'discount' => $product['discount']
            ]);
        }
        if ($replacements !== []) {
            $this->order->update(['status' => 'replacement']);
            if (empty($replacements['create'])) $replacements['create'] = [];
            if (empty($replacements['edit'])) $replacements['edit'] = [];
            if (empty($replacements['delete'])) $replacements['delete'] = [];
            $response = Http::withBasicAuth(env('API_USERNAME'), env('API_USERNAME'))
                ->patch(env('WAREHOUSE_URL').'api/order/edit/'.$this->order->id, $replacements);
        }
    }
}
