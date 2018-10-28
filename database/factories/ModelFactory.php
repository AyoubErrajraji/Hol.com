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
        'email_on_new_sales' => true
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

$factory->define(App\Product_Category::class, function(Faker\Generator $faker) {
    return [
        'product_id' => function() {
            return \App\Product::inRandomOrder()->first()->id;
        },
        'category_id' => function() {
            return \App\Category::inRandomOrder()->first()->id;
        },
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

$factory->define(App\Cart::class, function(Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
        }
    ];
});

$factory->define(App\CartItem::class, function(Faker\Generator $faker) {
    return [
        'product_id' => function() {
            return \App\Product::inRandomOrder()->first()->id;
        },
        'cart_id' => function() {
            return \App\Cart::inRandomOrder()->first()->id;
        }
    ];
});

$factory->define(App\Address::class, function(Faker\Generator $faker) {
    return [
        'country' => $faker->country(),
        'city' => $faker->city(),
        'zip_code' => $faker->postcode(),
        'street' => $faker->streetName(),
        'number' => $faker->buildingNumber(),
    ];
});

$factory->define(App\User_has_Address::class, function(Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return \App\User::inRandomOrder()->unique()->id;
        },
        'address_id' => function() {
            return \App\Address::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\Order::class, function(Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
        },
        'state_id' => function() {
            return \App\OrderState::inRandomOrder()->first()->id;
        },
        'address_id' => function() {
            return \App\Address::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\Order_has_Products::class, function(Faker\Generator $faker) {
    return [
        'order_id' => function() {
            return \App\Order::inRandomOrder()->first()->id;
        },
        'product_id' => function() {
            return \App\Product::inRandomOrder()->first()->id;
        },
        'amount' => $faker->numberBetween(1,10)
    ];
});

$factory->define(App\Payment::class, function(Faker\Generator $faker) {
    return [
        'payment_date' => $faker->date('Y-m-d H:i:s'),
        'order_id' => function() {
            return \App\Order::inRandomOrder()->first()->id;
        },
        'type_id' => function() {
            return \App\PaymentType::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\Review::class, function(Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
        },
        'product_id' => function() {
            return \App\Product::inRandomOrder()->first()->id;
        },
        'star_count' => $faker->numberBetween(1,5)
    ];
});

