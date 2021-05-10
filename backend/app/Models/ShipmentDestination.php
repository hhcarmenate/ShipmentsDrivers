<?php

namespace App\Models;

use App\Observers\ShipmentDestinationObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentDestination extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'address_2', 'city', 'state', 'zip', 'country'];

    /**
     * Create Hash for unique address
     * @return string
     */
    public function createHash()
    {
       return  md5(
           "{$this->attributes["address"]} {$this->attributes["city"]}, {$this->attributes["state"]} {$this->attributes["zip"]} {$this->attributes["country"]}"
       );
    }

    /**
     * Model observer
     */
    public static function boot()
    {
        ShipmentDestination::observe(ShipmentDestinationObserver::class);
    }
}
