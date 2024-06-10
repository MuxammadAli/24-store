<?php

namespace App\Jobs\Site\Checkout;

use App\Models\Cart as CartModel;
use App\Models\OrderProducts;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductsOrderStoreJob
{
    protected $request;
    protected $order;

    /**
     * ProductsOrderStoreJob constructor.
     * @param $request
     * @param $order
     */
    public function __construct($request, $order)
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
        foreach ($this->request->input('products') as $product) {
            $cart = CartModel::find($product);
            if (!empty($cart)) {
                $discount = $cart->product->price_discount ? 100 - $cart->product->price_discount * 100 / $cart->product->price : null;

                OrderProducts::create([
                    'order_id' => $this->order->id,
                    'product_id' => $cart->product->id,
                    'discount' => round($discount),
                    'count' => $cart->count,
                    'size' => $cart->size,
                    'color_id' => $cart->product_id,
                    'price' => $cart->product->getRealPrice(),
                    'supplier_id' => $cart->product->supplier_id ?? 0
                ]);
            }
        }
    }
}
