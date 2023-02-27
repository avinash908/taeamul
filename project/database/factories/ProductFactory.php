<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'slug' => str_replace(' ', '-', $faker->unique()->name),
        'sku' => $faker->randomDigit,
        'name' => $faker->name,
        'description' => $faker->text,
        'price' => $faker->randomDigit,
        'old_price' => $faker->randomDigit,
        'stock' => $faker->randomDigit,
        'short_description' => 'JKJ jkJ jk jsduJNNNdi KKKAsun  in msdbsjdvsdj ak',
        'is_featured'=>1,
        'is_bestSeller'=>1,
        'is_topRated'=>1,
        'is_bestDeals'=>1,
        'is_hot'=>1,
        'is_new'=>1,
        'is_trending'=>1,
        'is_sale'=>1,
        'remember_token' => Str::random(10),
    ];
});
