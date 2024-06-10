<?php

namespace App\Http\Resources\Api\Recovery;

use Illuminate\Http\Resources\Json\JsonResource;

class RecoveryProductsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->productable_id,
            'count' => $this->pivot->count
        ];
    }
}
