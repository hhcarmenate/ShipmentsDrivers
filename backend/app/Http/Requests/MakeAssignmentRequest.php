<?php

namespace App\Http\Requests;

use App\Models\ShipmentDestinationsDrivers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class MakeAssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'shipments_data' => 'required',
            'drivers_data'  => 'required'
        ];
    }

    /**
     * Get All shipments by Dates
     * @return Collection
     */
    public function getAllShipments()
    {
        return ShipmentDestinationsDrivers::get()->groupBy('shipment_date');
    }

}
