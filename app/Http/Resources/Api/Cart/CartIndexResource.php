<?php

namespace App\Http\Resources\Api\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartIndexResource extends JsonResource
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
            'name' => $this->getFullName(),
            'phone' => $this->getPhone(),
            'region' => [
                'id' => $this->region->region_id,
                'name' => $this->region->name['ru'] ?? ''
            ],
            'deadline' => $this->deadline
        ];
    }
}
