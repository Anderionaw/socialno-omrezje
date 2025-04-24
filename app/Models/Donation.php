<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Donation extends Model {
 
    use HasFactory;
    use LogsActivity;

    protected $table = 'donations';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'code',
        'title',
        'date',
        'reference',
        'description'
    ];

    /*
    public function getRealTitleAttribute( $value ) {
        return $this->zip . ' ' . $this->name;
    }
    */
    
    public function donation_donations() {
        return $this->hasMany(DonorDonation::class, 'donation_id', 'id')->orderBy('date', 'ASC')->orderBy('id', 'ASC');
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }

}
