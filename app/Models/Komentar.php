<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Komentar extends Model {
 
    use HasFactory;

    protected $table = 'komentarji';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_objave',
        'id_uporabnika',
        'vsebina',
        'stevilo_vseckov'
    ];

    /*
    public function getRealTitleAttribute( $value ) {
        return $this->zip . ' ' . $this->name;
    }
    */

    public function objava() {
        return $this->hasOne(Objava::class, 'id', 'id_objave');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_uporabnika');
    }   
}
