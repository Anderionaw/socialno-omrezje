<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Gender extends Model {
    
    use HasFactory;
    use LogsActivity;

    protected $table = 'genders';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'active',
        'position',
        'name'
    ];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }

}
