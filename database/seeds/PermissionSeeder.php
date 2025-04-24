<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('permissions')->insert([
            [
                'id' => 2, 
                'name' => 'manage_role',
                'guard_name' => 'web',
            ],
            [
                'id' => 3, 
                'name' => 'manage_permission',
                'guard_name' => 'web',
            ],
            [
                'id' => 4, 
                'name' => 'manage_user',
                'guard_name' => 'web',
            ],
            [
                'id' => 5, 
                'name' => 'view_dashboard',
                'guard_name' => 'web',
            ],
            [
                'id' => 6, 
                'name' => 'view_administration',
                'guard_name' => 'web',
            ],
            [
                'id' => 7, 
                'name' => 'view_users',
                'guard_name' => 'web',
            ],
            [
                'id' => 8, 
                'name' => 'view_roles',
                'guard_name' => 'web',
            ],
            [
                'id' => 9, 
                'name' => 'view_permissions',
                'guard_name' => 'web',
            ],
            [
                'id' => 10, 
                'name' => 'view_activities',
                'guard_name' => 'web',
            ],
            [
                'id' => 11, 
                'name' => 'view_import',
                'guard_name' => 'web',
            ],
            [
                'id' => 12, 
                'name' => 'view_subpages',
                'guard_name' => 'web',
            ],
            [
                'id' => 13, 
                'name' => 'view_postmails',
                'guard_name' => 'web',
            ]

        ]);

    }
}
