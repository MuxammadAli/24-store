<?php

namespace App\Http\Resources\Api\Agent;

use Illuminate\Http\Resources\Json\JsonResource;

class AgentPlansResource extends JsonResource
{
    public static $wrap = false;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'name' => $this->product->name['ru'],
            'count' => $this->count
        ];
    }
}
