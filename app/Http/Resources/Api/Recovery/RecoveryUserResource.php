<?php

namespace App\Http\Resources\Api\Recovery;

use Illuminate\Http\Resources\Json\JsonResource;

class RecoveryUserResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address
        ];
    }
}
