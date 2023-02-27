<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title'=>$faker->name,
        'slug'=> str_replace(' ', '-', $faker->name),
        'status'=> 1,
        'description'=> $faker->paragraph,
        'category_id'=> null,
    ];
});
