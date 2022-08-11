<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectProstulant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'prenom',
        'email',
    ];
}
