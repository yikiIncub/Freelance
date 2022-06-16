<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'domaine',
        'specialite',
        'experience',
        'motivation',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
