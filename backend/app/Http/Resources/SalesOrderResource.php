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
            'soDate'      => $this->date,
            'soCreatedAt' => $this->created_at,
            'soUpdatedAt' => $this->updated_at,
            'customer'    => new CustomerResource($this->customer),
            'soMaterials' => SalesOrderDetailResource::collection($this->salesOrderDetail)
        ];
    }
}
