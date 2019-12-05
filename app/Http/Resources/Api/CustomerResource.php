<?php

namespace App\Http\Resources\Api;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Customer $resource
 */
class CustomerResource extends JsonResource
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
            'id'           => $this->resource->id,
            'first_name'   => $this->resource->first_name,
            'last_name'    => $this->resource->last_name,
            'phone_number' => $this->resource->phone_number,
        ];
    }
}
