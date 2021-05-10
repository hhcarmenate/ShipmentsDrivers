<?php

namespace App\Http\Requests;

use App\Models\ShipmentDestinationsDrivers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class AllShipmentsRequest extends FormRequest
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
        return [];
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
