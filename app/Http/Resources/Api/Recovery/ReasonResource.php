<?php

namespace App\Http\Resources\Api\Recovery;

use Illuminate\Http\Resources\Json\JsonResource;

class ReasonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title
        ];
    }
}
