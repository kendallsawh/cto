<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConcessionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'label',
        'is_terminal',
        'display_order',
    ];

    /**
     * Applications that reference this status.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(ConcessionApplication::class, 'concession_status_id');
    }
}
