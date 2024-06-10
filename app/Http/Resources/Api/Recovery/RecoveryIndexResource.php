<?php

namespace App\Http\Resources\Api\Recovery;

use Illuminate\Http\Resources\Json\JsonResource;

class RecoveryIndexResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'user' => (new RecoveryUserResource($this->user)),
            'agent' => new RecoveryAgentResource($this->agent),
            'reason' => new ReasonResource($this->reason),
            'region' => new RecoveryRegionResource($this->agent->region),
            'created_at' => $this->created_at
        ];
    }
}
