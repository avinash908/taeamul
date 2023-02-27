<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $permissions = [
            // dashboard
            [
                'name'        => 'can view earning status',
                'guard_name'  => 'admin',
            ],

            // products permissions
            [
                'name'        => 'can manage products',
               'guard_name'  => 'admin',
            ],

            // orders permissions
            [
                'name'        => 'can manage orders',
                'guard_name'  => 'admin',
            ],

            // customers permissions
            [
                'name'        => 'can manage customers',
                'guard_name'  => 'admin',
            ],
            // Vendor permissions
            [
                'name'        => 'can manage vendors',
                'guard_name'  => 'admin',
            ],
             // categories permissions
            [
                'name'        => 'can manage categories',
                'guard_name'  => 'admin',
            ],
             // pages permissions
            [
                'name'        => 'can manage pages',
                'guard_name'  => 'admin',
            ],
            // blog permissions
            [
                'name'        => 'can manage blog',
                'guard_name'  => 'admin',
            ],
            // messages permissions
            [
                'name'        => 'can manage messages',
                'guard_name'  => 'admin',
            ],
            // reviews permissions
            [
                'name'        => 'can manage product reviews',
                'guard_name'  => 'admin',
            ],
             // wholesale permissions
            [
                'name'        => 'can manage wholesale units',
                'guard_name'  => 'admin',
            ],
              // banners permissions
            [
                'name'        => 'can manage banners',
                'guard_name'  => 'admin',
            ],
             // coupons permissions
            [
                'name'        => 'can manage coupons',
                'guard_name'  => 'admin',
            ],
             // subscribers permissions
            [
                'name'        => 'can manage subscribers',
                'guard_name'  => 'admin',
            ],
             // language permissions
            [
                'name'        => 'can manage language translation',
                'guard_name'  => 'admin',
            ],
             // seo permissions
            [
                'name'        => 'can manage seo',
                'guard_name'  => 'admin',
            ],
           
        ];

        DB::table('permissions')->delete();
        foreach ($permissions as $value) {
            Permission::create($value);
        }
    }
}
