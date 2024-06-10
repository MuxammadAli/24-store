<?php

namespace App\Http\Resources\Api\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderIndexResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->getFullName(),
                'phone' => $this->user->phone
            ],
            'phone' => $this->address->phone_other ?? '',
            'agent' => $this->agent ? [
                'id' => $this->agent->id,
                'name' => $this->agent->getFullName()
            ] : null,
            'region_id' => $this->user->region_id,
            'region' => $this->getRegion(),
            'address' => $this->getAddress(),
            'comments' => $this->comment,
            'payment_type' => $this->payment_type,
            'status' => $this->getStatus(),
            'total_price' => $this->price_product,
            'price_delivery' => $this->price_delivery,
            'location' => $this->address ? $this->address->getUrl() : '',
            'products' => $this->products,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
