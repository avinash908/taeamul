<?php

use Illuminate\Database\Seeder;
use App\Page;
class SEOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seo')->delete();

        $pages = Page::where('type','=','default')->get();

        foreach ($pages as $page) {

        	DB::table('seo')->insert([
	        	'title' => '',
	        	'meta_tags' => '',
	        	'meta_description' => '',
	        	'seoble_id' => $page->id,
	        	'seoble_type' => 'App\Page',
	        	'created_at' => now(),
	        	'updated_at' => now(),
	        ]);

        }
    }
}
