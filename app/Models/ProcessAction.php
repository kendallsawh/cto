<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessAction extends Model
{
    protected $fillable = ['process_step_id', 'type', 'parameters'];

    protected $casts = [
        'parameters' => 'array',
    ];

    public function step()
    {
        return $this->belongsTo(ProcessStep::class);
    }
}

