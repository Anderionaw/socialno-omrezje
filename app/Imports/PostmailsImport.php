<?php

namespace App\Imports;

use App\Models\Postmail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostmailsImport implements ToModel
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row) {

        return new Postmail([
            'active'     => 1,
            'zip'     => $row[0],
            'name'    => $row[1]
        ]);
        
    }
    
}
