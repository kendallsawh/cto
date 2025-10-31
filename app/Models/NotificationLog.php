<?php

// app/Models/NotificationLog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $fillable = [
        'user_id','doc_type_id','document_ref','channel','status','error',
    ];
}
