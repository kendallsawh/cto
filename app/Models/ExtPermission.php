<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
class ExtPermission extends Permission
{
    use HasFactory;

    protected $table = 'permission';

    protected $fillable = [
        'id',
        'name',
        'description',
        'guard_name'
    ];
}
