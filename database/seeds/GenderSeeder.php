<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('genders')->insert([
            [
                'id' => 1, 
                'active' => 1,
                'position' => 1,
                'name' => 'Moški'
            ],
            [
                'id' => 2, 
                'active' => 1,
                'position' => 1,
                'name' => 'Ženski'
            ],
        ]);
        
    }
}
