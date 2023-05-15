<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\candidate_result;

class geometries extends Model
{
    use HasFactory;
    protected $table = 'election_geometries';
    public function result()
    {
        return $this->belongsToMany('App\Models\candidate_result');
    }
}