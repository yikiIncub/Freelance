<?php

namespace App\Models;

use App\Models\Competence;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'type',
        'telephone',
        'nationalite',
        'photo',
        'residence',
        'sexe',
        'password',

    ];
    public $appends=['profil_image_url'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotefication($token){
        $url='https://spa.test/reset-password?token='. $token;
        $this->notify(new ResetPasswordNotification($url));
    }
    public function getProfilImageUrlAttribute(){
        if($this->photo){
            return asset('/uploads/profil_images/'.$this->photo);
        }else{
          return 'https://ui-avatars.com/api/?name='.urldecode($this->name); 
        }
       
    }
    public function domaine(){
        return $this->belongsToMany(Domaine::class);
    }
    public function projet(){
        return $this->belongsToMany(Projet::class);
    }
   
    
}
