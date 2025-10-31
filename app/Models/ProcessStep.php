<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = ['process_flow_id', 'name', 'order', 'is_final'];

    public function flow()
    {
        return $this->belongsTo(ProcessFlow::class, 'process_flow_id');
    }

    public function conditions()
    {
        return $this->hasMany(ProcessCondition::class);
    }

    public function actions()
    {
        return $this->hasMany(ProcessAction::class);
    }
}

