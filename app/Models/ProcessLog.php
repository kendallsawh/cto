<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessLog extends Model
{
    protected $fillable = ['process_instance_id', 'step_id', 'user_id', 'note', 'metadata', 'completed_at'];

    protected $casts = [
        'metadata' => 'array',
        'completed_at' => 'datetime',
    ];

    public function instance()
    {
        return $this->belongsTo(ProcessInstance::class);
    }

    public function step()
    {
        return $this->belongsTo(ProcessStep::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

