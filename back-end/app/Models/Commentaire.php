<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'user_id',
        'projet_id',
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
     public function getHumanReadableCreatedAtAttribute(){
            return $this ->created_at->difforHumans();
        }
}
