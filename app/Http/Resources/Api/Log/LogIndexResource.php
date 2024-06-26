<?php

namespace App\Http\Resources\Api\Log;

use Illuminate\Http\Resources\Json\JsonResource;

class LogIndexResource extends JsonResource
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
            'order_id' => $this->subject_id,
            'action' => $this->description,
            'properties' => $this->properties,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
