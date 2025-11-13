<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsModelChanges;

class ActivityParticular extends Model
{
    use HasFactory, SoftDeletes, LogsModelChanges;
    protected $fillable = ['activity_id','particulars','particulars_cost','created_by','updated_by'];
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity', 'activity_id', 'id');
    }

}
