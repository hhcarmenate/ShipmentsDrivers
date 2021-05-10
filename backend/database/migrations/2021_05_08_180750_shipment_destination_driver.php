<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShipmentDestinationDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_destinations_drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_destination_id');
            $table->unsignedBigInteger('driver_id');
            $table->date('shipment_date');
            $table->foreign('shipment_destination_id')->references('id')->on('shipment_destinations');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_destinations_drivers');
    }
}
