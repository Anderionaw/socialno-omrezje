<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Prijateljstvo extends Model {
 
    use HasFactory;

    protected $table = 'prijateljstva';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_uporabnika1',
        'id_uporabnika2',
        'sprejeto'
    ];

    public function user1() {
        return $this->belongsTo(User::class, 'id_uporabnika1');
    }

    public function user2() {
        return $this->belongsTo(User::class, 'id_uporabnika2');
    }


}
