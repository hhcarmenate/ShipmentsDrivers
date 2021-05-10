<?php

namespace App\Http\Resources\Shipments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignShipmentsResource extends JsonResource
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
            'address'           => $this->address,
            'driver_name'       => $this->driver_assigned->getCompletedName(),
            'suitable_score'    => $this->driver_assigned->getSuitabilityScore()
        ];
    }
}
