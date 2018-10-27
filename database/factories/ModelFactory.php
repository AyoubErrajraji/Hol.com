<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Settings::class, function(Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return \App\User::inRandomOrder()->unique()->id;
        },
        'email_on_outbit' => true,
        'email_on_closed_watchlistitem' => true,
        'email_on_bid_for_your_ad' => true,
    ];
});

$factory->define(App\Product::class, function(Faker\Generator $faker) {

   return [
        'title' => $faker->realText(rand(10, 26)),
        'active' => 1,
        'price' => $faker->randomFloat(0, 0, 250),
        'body' => $faker->realText(rand(100, 260)),
        'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
        },
        'image' => 'agilepixels.jpg'
   ];
});

$factory->define(App\WishList::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->realText(rand(10, 26)),
        'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
        }
    ];
});

$factory->define(App\WishListItem::class, function(Faker\Generator $faker) {
    return [
        'product_id' => function() {
            return \App\Product::inRandomOrder()->first()->id;
        },
        'wishlist_id' => function() {
            return \App\WishList::inRandomOrder()->first()->id;
        }
    ];
});


