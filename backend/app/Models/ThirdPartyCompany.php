<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThirdPartyCompany extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    /**
     * This company has many users
     * @return HasMany
     */
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}
