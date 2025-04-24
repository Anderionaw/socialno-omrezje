<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Objava;
use App\Models\Vsecki;
use App\Models\Prijateljstvo;

use App\Notifications\CustomResetPassword;

class User extends Authenticatable {

    use HasApiTokens,Notifiable;
    //use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'stevilo_prijateljev',
        'slika'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    public function objave(){
        return $this->hasMany(Objava::class, "id_uporabnika", "id")->orderBy("created_at", 'DESC');
    }

    public function komentarji(){
        return $this->hasMany(Komentar::class);
    }

    public function prijatelji1(){
        return $this->hasMany(Prijateljstvo::class, "id_uporabnika2", "id");
    }

    public function prijatelji2(){
        return $this->hasMany(Prijateljstvo::class, "id_uporabnika1", "id");
    }

    public function vsecki(){
        return $this->hasMany(Vsecki::class, "id_uporabnika", "id");
    }

    public function hasRole(){}

}
