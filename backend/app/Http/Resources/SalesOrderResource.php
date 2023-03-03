<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'soId'        => $this->id,
            'soInvoice'   => $this->invoice,
            'soCreatedAt' => $this->created_at,
            'soUpdatedAt' => $this->updated_at,
            'soMaterials' => SalesOrderDetailResource::collection($this->salesOrderDetail)
        ];
    }
}
