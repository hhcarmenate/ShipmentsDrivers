<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'third_party_company_id'];

    /**
     * This user belongs to a company
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(ThirdPartyCompany::class);
    }

    /**
     * This driver has an user
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
