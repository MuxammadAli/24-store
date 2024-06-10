<?php

namespace App\Http\Resources\Api\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'created_at' => $this->created_at
        ];
    }
}
