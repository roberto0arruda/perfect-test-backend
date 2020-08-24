<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product' => ProductResource::make($this->product),
            'customer' => CustomerResource::make($this->customer),
            'date' => Carbon::parse($this->date)->format('d/m/Y') . Carbon::parse($this->created_at)->format(' H\hi'),
            'quantity' => $this->quantity,
            'discount' => number_format($this->discount, 2),
            'status' => $this->status
        ];
    }
}
