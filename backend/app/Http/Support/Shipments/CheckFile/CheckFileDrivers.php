<?php


namespace App\Http\Support\Shipments\CheckFile;

use App\Http\Resources\Shipments\DriversResource;

class CheckFileDrivers extends CheckFile
{
    /**
     * Get excel data needed
     * @return mixed|void
     */
    public function getExcelData()
    {
        $drivers = collect();
        if(count($this->excel_data)) {
            foreach ($this->excel_data as $data) {
                if(count($data)) {
                    foreach ($data as $element) {
                        $drivers->push([
                            'first_name'   => $element[0] ?? 'Unknown',
                            'last_name'    => $element[1] ?? 'Unknown',
                        ]);
                    }
                }
            }
        }

        return DriversResource::collection($drivers);
    }
}
