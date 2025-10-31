<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessInstance extends Model
{
    protected $fillable = ['process_flow_id', 'model_type', 'model_id', 'current_step_id', 'completed_at'];

    protected $dates = ['completed_at'];

    public function model()
    {
        return $this->morphTo();
    }

    public function flow()
    {
        return $this->belongsTo(ProcessFlow::class, 'process_flow_id');
    }

    public function currentStep()
    {
        return $this->belongsTo(ProcessStep::class, 'current_step_id');
    }

    public function logs()
    {
        return $this->hasMany(ProcessLog::class);
    }
}

