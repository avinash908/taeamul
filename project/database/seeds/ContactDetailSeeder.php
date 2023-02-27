<?php

use Illuminate\Database\Seeder;

class ContactDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_details')->delete();
        DB::table('contact_details')->insert([
            'id'=>1,
        ]);
    }
}
