<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\provinces;
use App\Models\party;

class candidate_result extends Model
{
    use HasFactory;
    protected $table = 'candidate_result';
    
}