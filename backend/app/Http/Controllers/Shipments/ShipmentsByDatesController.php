<?php

namespace App\Http\Controllers\Shipments;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakeAssignmentRequest;
use App\Http\Resources\Shipments\AssignShipmentsResource;
use App\Http\Support\Shipments\ShipmentDestinationAssign;
use Inertia\Inertia;
use Inertia\Response;

class ShipmentsByDatesController extends Controller
{
    /**
     * Create Shipments by drivers
     * @return Response
     */
    public function create() {
        return Inertia::render('Shipments/Create');
    }

    /**
     * Make assign by shipments destination and drivers (mathematical model :P)
     * @param MakeAssignmentRequest $request
     * @return Response
     */
    public function makeAssignments(MakeAssignmentRequest $request)
    {
        return Inertia::render('Shipments/Assigned',
            [
                'assignments' => AssignShipmentsResource::collection((new ShipmentDestinationAssign($request))->getShipmentsData())
            ]);
    }

}
