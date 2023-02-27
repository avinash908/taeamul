<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $roles = [
            [
                'name'              => 'admin',
                'guard_name'        => 'admin',
            ],
            [
                'name'              => 'editor',
                'guard_name'        => 'admin',
            ],
            [
                'name'              => 'employe',
                'guard_name'        => 'admin',
            ],
        ];


       DB::table('roles')->delete();

       foreach ($roles as $value) {
            Role::create($value);       
        }

       $permissions = Permission::all();

       $roles = Role::where('name','=','admin')->orWhere('name','=','editor')->get();

       foreach ($roles as $role) {
        
        $role->syncPermissions($permissions);
          
       }
    }
}