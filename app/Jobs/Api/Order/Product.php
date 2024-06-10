<?php

namespace App\Jobs\Api\Order;

use App\Models\Order;
use App\Http\Requests\Api\Order\Request as OrderRequest;
use App\Models\OrderProducts;
use App\Models\Product as Model;


class Product
{
    protected $request;
    protected $order;

    /**
     * Product constructor.
     * @param Order $order
     * @param OrderRequest $request
     */
    public function __construct(Order $order, OrderRequest $request)
    {
        $this->request = $request;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->request->getProducts() as $product) {
            $row = Model::find($product['id']);

            $discount = $row->price_discount ? 100 - $row->price_discount * 100 / $row->price : null;

            OrderProducts::create([
                'order_id' => $this->order->id,
                'product_id' => $product['id'],
                'discount' => $discount,
                'count' => $product['count'],
                'size' => $product['size'],
                'color_id' => $product['color_id']
            ]);
        }

    }
}
