<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DonorDonation extends Model {
 
    use HasFactory;
    use LogsActivity;

    protected $table = 'donors_donations';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'donor_id',
        'donation_id',
        'reference',
        'amount',
        'date',
        'description'
    ];

    public function donor() {
        return $this->belongsTo(Donor::class, 'donor_id', 'id');
    }

    public function donation() {
        return $this->belongsTo(Donation::class);
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }

}
