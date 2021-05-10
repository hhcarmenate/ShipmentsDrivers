<?php

namespace App\Http\Controllers\Shipments;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllShipmentsRequest;
use App\Http\Requests\CheckFilesShipmentRequest;
use App\Http\Resources\Shipments\ShipmentsDestinationDriversResource;
use App\Http\Support\Shipments\CheckFile\CheckFileDrivers;
use App\Http\Support\Shipments\CheckFile\CheckFileShipments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ShipmentsByDatesApiController extends Controller
{
    /**
     * Get all my lists
     * @param AllShipmentsRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function index(AllShipmentsRequest $request) {
        $this->response->data = [
            'data'      => ShipmentsDestinationDriversResource::collection($request->getAllShipments()),
            'message'   => 'Shipments loaded successfully'
        ];
        return $this->response->successResponse();
    }

    /**
     * Check file structure
     * @param CheckFilesShipmentRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function checkFile(CheckFilesShipmentRequest $request)
    {
        $check_file = ($request->input('type' ) === 'shipments_destinations' )
                        ? new CheckFileShipments($request->file('data')) : new CheckFileDrivers($request->file('data'));
        if(!$errors = $check_file->errors()) {
            $this->response->data = [
                'data'      => $check_file->getExcelData(),
                'message'   => 'Excel Processed successfully'
            ];
            return $this->response->successResponse();
        }
        $this->response->data = ['data' => [], 'message' => $errors];
        return $this->response->serverErrorResponse();
    }


}
