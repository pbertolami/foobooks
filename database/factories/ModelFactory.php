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

$factory->define(Foobooks\User::class, function (Faker\Generator $faker) {
    return [
        'created_at'     => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at'     => Carbon\Carbon::now()->toDateTimeString(),
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Foobooks\Flyer::class, function (Faker\Generator $faker) {
    return [
        'created_at'    => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at'    => Carbon\Carbon::now()->toDateTimeString(),
        'user_id'       =>factory('Foobooks\User')->create()->id,
        'street'        =>$faker->streetAddress,
        'city'          =>$faker->city,
        'zip'           =>$faker->postcode,
        'state'         =>$faker->state,
        'country'       =>$faker->country,
        'price'         =>$faker->numberBetween(10, 5000),
        'description'   =>$faker->paragraph
    ];
});
$factory->define(Foobooks\Photo::class, function (Faker\Generator $faker){
    return [
        'created_at'        => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at'        => Carbon\Carbon::now()->toDateTimeString(),
        'flyer_id'          =>factory('Foobooks\Flyer')->create()->id,
        'name'              =>$faker->name($gender = null|'male'|'female'),
        'path'              =>' ',
        'thumbnail_path'    =>$faker->imageUrl($width = 640, $height = 480),
    ];
});