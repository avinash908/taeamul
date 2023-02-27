<?php

use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_settings')->delete();
        DB::table('payment_settings')->insert([
        	'id'=>1,
        	'currency_format'=>'Sr',
        	'withdraw_fee'=>0,
        	'commission_charges'=>10,
        	'charge_in_percentage'=>1,
        ]);
    }
}
