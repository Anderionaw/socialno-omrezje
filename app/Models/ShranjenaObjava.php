<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class ShranjenaObjava extends Model {
 
    use HasFactory;
    protected $table = 'shranjene_objave';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_objave',
        'id_uporabnika',
    ];

    public function objava() {
        return $this->hasOne(Objava::class, 'id', 'id_objave');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_uporabnika');
    }

    public function getObjava(){
        return $this->objava;
    }

}
