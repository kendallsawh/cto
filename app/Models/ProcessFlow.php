<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessFlow extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'model_type', 'model_id'];

    public function model()
    {
        return $this->morphTo();
    }

    public function steps()
    {
        return $this->hasMany(ProcessStep::class);
    }

    public function instances()
    {
        return $this->hasMany(ProcessInstance::class);
    }
}
