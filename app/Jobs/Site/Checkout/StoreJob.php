<?php

namespace App\Jobs\Site\Checkout;

use App\Models\Order;

class StoreJob
{
    protected $request;
    protected $address;
    protected $delivery_price;
    protected $price_product;
    protected $currency;

    /**
     * StoreJob constructor.
     * @param $request
     * @param $address
     * @param $delivery_price
     * @param $currency
     * @param $product_total
     */
    public function __construct($request, $address, $delivery_price, $currency, $product_total)
    {
        $this->request = $request;
        $this->address = $address;
        $this->delivery_price = $delivery_price;
        $this->currency = $currency;
        $this->price_product = $product_total;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return Order::create([
            'user_id' => auth()->user()->id,
            'address_id' => $this->address->id,
            'first_name' => $this->request->order['first_name'],
            'last_name' => $this->request->order['last_name'],
//            'type_delivery' => $this->request->delivery_type,
            'price_delivery' => $this->delivery_price,
            'currency' => $this->currency,
            'payment_type' => $this->request->order['payment_type'],
            'payment_status' => $this->request->getPaymentStatus(),
            'comment' => $this->request->order['comment'],
            'price_product' => $this->price_product
        ]);
    }
}
