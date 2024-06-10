<?php

namespace App\Http\Resources\Api\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryParentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name[request()->header('Accept-Language', 'ru')] ?? '',
            'image' => '/' . $this->getImage(),
            'subCategories' => self::collection($this->children)->all()
        ];
    }
}
