<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'national_id',
        'passport',
        'tt_biz_id',
        'address_lot_apt',
        'address_street',
        'address_town',
        'contact_business',
        'contact_mobile',
    ];

    /**
     * Get the user that owns the individual profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
