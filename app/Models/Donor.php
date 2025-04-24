<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Donor extends Model {
 
    use HasFactory;
    use LogsActivity;

    protected $table = 'donors';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'active',
        'regular',
        'permanent_deletion',
        'online',
        'code',
        'name',
        'surname',
        'address',
        'postmail_id',
        'phone',
        'email',
        'featured_image',
        'description'
    ];

    /*
    public function getRealTitleAttribute( $value ) {
        return $this->zip . ' ' . $this->name;
    }
    */

    public function postmail() {
        return $this->hasOne(Postmail::class, 'id', 'postmail_id');
    }

    public function donor_donations() {
        return $this->hasMany(DonorDonation::class)->orderBy('date', 'ASC')->orderBy('id', 'ASC');
    }

    public function getIndexRowClass() {

        $rowClass = '';

        if ($this->permanent_deletion == 1) {

            $rowClass .= 'mct-permanent-deletion';

        } else if ($this->online == 1) {

            $rowClass .= 'mct-online';

        } else if ($this->regular == 1) {

            $rowClass .= 'mct-regular';

        } else if ($this->active == 1) {

            $rowClass .= 'mct-active';

        } else if ($this->active == 0) {

            $rowClass .= 'mct-inactive';

        }

        return $rowClass;

    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }

}
