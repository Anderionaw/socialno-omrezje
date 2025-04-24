<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Objava extends Model {
 
    use HasFactory;

    protected $table = 'objave';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_uporabnika',
        'vsebina',
        'slika',
    ];

    public function najdi($id){
        return $this->findOrFail($id);
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_uporabnika');
    }

    public function komentarji(){
        return $this->hasMany(Komentar::class, 'id_objave', 'id');
    }

}
