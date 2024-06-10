<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'region_id' => $this->region_id,
            'name' => $this->name,
            'inn' => $this->inn,
            'location' => !empty($this->location) ? $this->getUrl() : null,
            'customer' => $this->customer,
            'address' => $this->address,
            'image' => $this->getImage(),
            'agent_id' => $this->agent_id,
            'fullname' => $this->getFullName(),
            'region_name' => $this->region->name['ru'],
            'orders' => $this->orders->map(function ($order) {
                $order->region_name = isset($order->address) ? $order->address->getRegion() : $this->region->name['ru'];
                $order->status_color = $order->getStatusColor();
                $order->status = $order->getStatus();
                return $order;
            }),
            'orders_price' => $this->getOrdersPrice(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
