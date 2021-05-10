<?php


namespace App\Http\Support\Shipments\CheckFile;

use App\Http\Resources\Shipments\ShipmentsDestinationResource;

class CheckFileShipments extends CheckFile
{
    /**
     * Get excel data needed
     * @return mixed|void
     */
    public function getExcelData()
    {
        $shipments_destinations = collect();
        if(count($this->excel_data)) {
            foreach ($this->excel_data as $data) {
                if(count($data)) {
                    foreach ($data as $element) {
                        $shipments_destinations->push([
                            'address'   => $element[0] ?? 'Unknown',
                            'city'      => $element[1] ?? 'Unknown',
                            'state'     => $element[2] ?? 'Unknown',
                            'zip'       => $element[3] ?? 'Unknown',
                        ]);
                    }
                }
            }
        }


        return ShipmentsDestinationResource::collection($shipments_destinations);
    }
}
