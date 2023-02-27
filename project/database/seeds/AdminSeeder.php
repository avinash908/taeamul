<?php
use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $admin = Admin::create([
            'id'=>1,
        	'name'=>'admin',
        	'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
        	'avatar'=>'assets/admin/images/avatar.png',
        	'phone'=>'',
        	// 'shop_name'=>env('APP_NAME','Laravel'),
        ]);

        $role = Role::where('name','=','admin')->first();

        $admin->assignRole($role);
    }
}
