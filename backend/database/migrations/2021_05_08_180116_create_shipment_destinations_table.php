<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_destinations', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('address_2');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country');
            $table->string("hashed_address")->nullable();
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
        Schema::dropIfExists('shipment_destinations');
    }
}
