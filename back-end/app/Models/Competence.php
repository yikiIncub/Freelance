<?php

namespace App\Models;


use App\Models\User;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Competence extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function domaine(){
        return $this->belongsToMany(Domaine::class);
    }
}
