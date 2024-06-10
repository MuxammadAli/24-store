<?php

namespace App\Http\Resources\Api\Recovery;

use Illuminate\Http\Resources\Json\JsonResource;

class RecoveryRegionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name['ru']
        ];
    }
}
