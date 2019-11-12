<?php

namespace App\Http\Resources\Api;

use App\Models\Coefficient;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Coefficient $resource
 */
class CoefficientResource extends JsonResource
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
            'id'             => $this->resource->id,
            'commerce_value' => CommerceValueResource::make($this->resource->commerceValue),
            'amount'         => $this->resource->amount,
            'percent'        => $this->resource->percent,
        ];
    }
}
