<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $name = $faker->word;
	return [
        'name' => $name,
		'slug' => str_slug($name),
		'description' => $faker->paragraph
    ];
});

$factory->define(App\Subcategory::class, function (Faker $faker) {
    $name = $faker->word;
	return [
        'name' => $name,
		'slug' => str_slug($name),
		'category_id'=>function(){
			return factory(App\Category::class)->create()->id;
		}
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    $name = $faker->word;
	return [
        'name' => $name,
		'slug' => str_slug($name),
		'quantity' =>$faker->randomDigitNotNull,
		'description' =>$faker->sentence,
		'image' => 'public/products/default.jpg',
		'price'=>$faker->numberBetween($min = 5, $max = 100),
		'subcategory_id' =>function(){
			return factory(App\Subcategory::class)->create()->id;
		}
    ];
});
