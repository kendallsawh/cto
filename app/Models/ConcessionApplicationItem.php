<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConcessionApplicationItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'concession_application_id',
        'item_id',
        'item_name',
        'category',
        'specification',
        'unit_id',
        'unit_name_snapshot',
        'unit_symbol_snapshot',
        'quantity',
        'unit_value',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_value' => 'decimal:2',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(ConcessionApplication::class, 'concession_application_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class, 'unit_id');
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function getLineTotalAttribute(): float
    {
        $quantity = (float) $this->quantity;
        $unitValue = (float) $this->unit_value;

        return $quantity * $unitValue;
    }
}
