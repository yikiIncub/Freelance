<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;
    protected $fillable = [
        'domaine',
        'specialite',
        'experience',
        'motivation',
    ];
     

    public function user(){
        return $this->belongsTo(User::class,'competence_users');
    }
        
    
}
