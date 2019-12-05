<?php

namespace App\Http\Resources\Api;

use App\Models\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Currency $resource
 */
class CurrencyResource extends JsonResource
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
            'id'   => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
