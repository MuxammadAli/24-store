<?php

namespace App\Jobs\Api\Order;

use App\Models\Currency;
use App\Models\Order;
use Illuminate\Support\Arr;
use App\Http\Requests\Api\Order\Request as OrderRequest;


class Store
{
    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['user_id', 'address_id', 'price_total', 'price_delivery', 'shipment_date', 'type_delivery', 'payment_type', 'comment', 'status', 'branch_id', 'price_product', 'payment_status', 'currency']);
    }

    /**
     * @param $user_id
     * @param $address_id
     * @param OrderRequest $request
     * @param $total
     * @param $delivery
     * @param $status
     * @param $product_total
     * @param Currency $currency
     * @return Store
     */
    public static function fromRequest($user_id, $address_id, OrderRequest $request, $total, $delivery, $status, $product_total, Currency $currency)
    {
        return new static([
            'user_id' => $user_id,
            'address_id' => $address_id,
            'price_total' => $total,
            'price_delivery' => $delivery,
            'shipment_date' => $request->getShipmentDate(),
            'type_delivery' => $request->getTypeDelivery(),
            'payment_type' => $request->getPaymentType(),
            'comment' => $request->getComment(),
            'status' => 0,
            'branch_id' => $request->getBranchID(),
            'price_product' => $product_total,
            'payment_status' => $status,
            'currency' => [
                'dollar' => $currency->dollar,
                'euro' => $currency->euro
            ]
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        return Order::create($this->attr);
    }
}
