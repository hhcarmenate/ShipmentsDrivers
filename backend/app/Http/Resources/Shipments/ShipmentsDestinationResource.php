<?php

namespace App\Http\Resources\Shipments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentsDestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'address'   => $this->resource["address"],
            'city'      => $this->resource["city"],
            'state'     => $this->resource["state"],
            'zip'       => $this->resource["zip"],
        ];
    }
}
