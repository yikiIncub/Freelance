<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Competence extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];
     
    public function domaine(){
        return $this->belongsTo(Domaine::class,'domaines');
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
        
    
}
