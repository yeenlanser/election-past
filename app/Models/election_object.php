<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class election_object extends Model
{
    use HasFactory;
    protected $table = 'election_object';
    
    public function geometries()
    {
        return $this->belongsToMany('App\Models\geometries');
    }
}