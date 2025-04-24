<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sporocilo extends Model {
 
    use HasFactory;

    protected $table = 'sporocila';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_uporabnika1',
        'id_uporabnika2',
        'vsebina',
    ];

    /*
    public function getRealTitleAttribute( $value ) {
        return $this->zip . ' ' . $this->name;
    }
    */

    public function user1() {
        return $this->hasOne(User::class, 'id_uporabnika1', 'id');
    }

    public function user2() {
        return $this->hasOne(User::class, 'id_uporabnika2', 'id');
    }

}
