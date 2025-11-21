<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeasurementUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'dimension',
        'notes',
    ];

    /**
     * Items using this as a default unit.
     */
    public function itemsDefaultFor(): HasMany
    {
        return $this->hasMany(Item::class, 'default_unit_id');
    }

    /**
     * Application items that reference this unit.
     */
    public function applicationItems(): HasMany
    {
        return $this->hasMany(ConcessionApplicationItem::class, 'unit_id');
    }
}
