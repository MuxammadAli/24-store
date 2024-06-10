<?php

namespace App\Http\Resources\Api\Recovery;

use Illuminate\Http\Resources\Json\JsonResource;

class RecoveryResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new RecoveryUserResource($this->user),
            'agent' => new RecoveryAgentResource($this->agent),
            'region' => new RecoveryRegionResource($this->agent->region),
            'status' => $this->status,
            'products' => RecoveryProductsResource::collection($this->products),
            'created_at' => $this->created_at
        ];
    }
}
