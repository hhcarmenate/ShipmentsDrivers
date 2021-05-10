<?php

namespace App\Http\Requests;

use App\Models\ShipmentDestinationsDrivers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class CheckFilesShipmentRequest extends FormRequest
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
            'type'  => 'required|in:shipments_destinations,drivers',
            'data'  => 'required|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/plain,application/csv,text/comma-separated-values,text/anytext,application/octet-stream,application/txt'
        ];
    }



}
