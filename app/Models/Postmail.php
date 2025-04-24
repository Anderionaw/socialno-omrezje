<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Postmail extends Model {
 
    use HasFactory;
    use LogsActivity;

    protected $table = 'postmails';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'active',
        'zip',
        'name'
    ];

    /*
    public function getRealTitleAttribute( $value ) {
        return $this->zip . ' ' . $this->name;
    }
    */

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }

}
