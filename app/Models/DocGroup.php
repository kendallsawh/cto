<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocGroup extends Model
{
    use HasFactory;
    
    public function psipDocs() {
        return $this->hasMany(PsipDoc::class);
    }
}
