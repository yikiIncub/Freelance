<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'competence_id',
    ];
     

}
