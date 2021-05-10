<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentDestinationsDrivers extends Model
{
    use HasFactory;

    protected $fillable = ['shipment_destination_id', 'driver_id', 'shipment_date'];

}
