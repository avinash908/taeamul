<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$deafult_pages = [
    		[
    			'title' => env('APP_NAME').' - Home',
    			'slug' => 'home',
    			'type' => 'default',
    			'content' => null,
                'created_at' => now(),
                'updated_at' => now(),
    		],
    		[
    			'title' => env('APP_NAME').' - Shop',
    			'slug' => 'shop',
    			'type' => 'default',
    			'content' => null,
                'created_at' => now(),
                'updated_at' => now(),
    		],
    		[
    			'title' => env('APP_NAME').' - Blog',
    			'slug' => 'blog',
    			'type' => 'default',
    			'content' => null,
                'created_at' => now(),
                'updated_at' => now(),
    		],
    		[
    			'title' => env('APP_NAME').' - Faqs',
    			'slug' => 'faqs',
    			'type' => 'default',
    			'content' => null,
                'created_at' => now(),
                'updated_at' => now(),
    		],
    		[
    			'title' => env('APP_NAME').' - Contact Us',
    			'slug' => 'contact_us',
    			'type' => 'default',
    			'content' => null,
                'created_at' => now(),
                'updated_at' => now(),
    		],
    	];

        DB::table('pages')->delete();
        DB::table('pages')->insert($deafult_pages);
    }
}
