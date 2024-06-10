<?php

namespace App\Http\Resources\Api\Recovery;

use Illuminate\Http\Resources\Json\JsonResource;

class RecoveryAgentResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getFullName(),
            'phone' => $this->phone
        ];
    }
}
