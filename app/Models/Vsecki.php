<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Vsecki extends Model {
 
    use HasFactory;

    protected $table = 'vsecki';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_objave',
        'id_uporabnika'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id_uporabnika', 'id');
    }

    public function komentarji(){
        return $this->hasMany(Komentar::class, 'id_objave', 'id');
    }

}
