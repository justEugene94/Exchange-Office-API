<?php

namespace App\Http\Resources\Api;

use App\Models\Purchase;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Purchase $resource
 */
class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'               => $this->resource->id,
            'customer'         => CustomerResource::make($this->resource->customer),
            'currency'         => CurrencyResource::make($this->resource->currency),
            'exchangeCurrency' => CurrencyResource::make($this->resource->exchangeCurrency),
            'value'            => $this->resource->value,
        ];
    }
}
