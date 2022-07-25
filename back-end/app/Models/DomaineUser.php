<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomaineUser extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'domaine_id',
        'user_id'
    ];
}
