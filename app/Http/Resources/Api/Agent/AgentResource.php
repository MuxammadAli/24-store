<?php

namespace App\Http\Resources\Api\Agent;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic,
            'birth_day' => $this->birth_day,
            'address' => $this->address,
            'balance' => $this->balance,
            'gender' => $this->gender,
            'gender_text' => $this->getGender(),
            'name' => $this->getFullName(),
            'phone' => $this->phone,
            'email' => $this->email,
            'image' => $this->getUrl(),
            'username' => $this->username,
            'region_id' => $this->region_id,
            'supplier_id' => $this->supplier_id,
            'status' => $this->status,
            'status_text' => $this->getStatus(),
            'blocked' => $this->blocked,
            'blocked_text' => $this->getBlocked(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'categories' => $this->categories()->select('id', 'name->ru as title')->get(),
            'region' => $this->region,
            'orders' => [
                'items' => $this->orders->items(),
                'pagination' => new PaginateResource($this->orders)
            ],
            'daily' => [
                'items' => $this->daily->items,
                'pagination' => new PaginateResource($this->daily->pagination)
            ],
            'plans' => AgentPlansResource::collection($this->plans)
        ];
    }
}
