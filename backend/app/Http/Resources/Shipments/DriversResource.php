<?php

namespace App\Http\Resources\Shipments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriversResource extends JsonResource
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
            'first_name'   => $this->resource["first_name"],
            'last_name'    => $this->resource["last_name"]
        ];
    }
}
