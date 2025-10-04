<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $order = [
            'id' => $this->id,
            'service_id' => $this->service_id,
            'Provider_id' => $this->provider_id,
            'client_id' => $this->client_id,
            'status' => $this->status,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        return $order;

       
    }
}
