<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'current' => $this->currentPage(),
            'previous' => $this->currentPage() > 1 ? $this->currentPage() - 1 : null,
            'next' => $this->hasMorePages() ? $this->currentPage() + 1 : null,
            'total' => $this->total(),
            'perPage' => $this->perPage()
        ];
    }
}
