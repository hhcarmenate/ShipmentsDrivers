<?php

namespace App\Observers;

use App\Models\ShipmentDestination;

class ShipmentDestinationObserver
{
    /**
     * Handle the ShipmentDestination "created" event.
     *
     * @param  \App\Models\ShipmentDestination  $shipmentDestination
     * @return void
     */
    public function created(ShipmentDestination $shipmentDestination)
    {
        $shipmentDestination->hashed_address = $shipmentDestination->createHash();
        $shipmentDestination->save();
    }

    /**
     * Handle the ShipmentDestination "updated" event.
     *
     * @param  \App\Models\ShipmentDestination  $shipmentDestination
     * @return void
     */
    public function updated(ShipmentDestination $shipmentDestination)
    {
        //
    }

    /**
     * Handle the ShipmentDestination "deleted" event.
     *
     * @param  \App\Models\ShipmentDestination  $shipmentDestination
     * @return void
     */
    public function deleted(ShipmentDestination $shipmentDestination)
    {
        //
    }

    /**
     * Handle the ShipmentDestination "restored" event.
     *
     * @param  \App\Models\ShipmentDestination  $shipmentDestination
     * @return void
     */
    public function restored(ShipmentDestination $shipmentDestination)
    {
        //
    }

    /**
     * Handle the ShipmentDestination "force deleted" event.
     *
     * @param  \App\Models\ShipmentDestination  $shipmentDestination
     * @return void
     */
    public function forceDeleted(ShipmentDestination $shipmentDestination)
    {
        //
    }
}
