<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\forum\forum_thread;
use App\Models\student\user_student;
use App\Models\teacher\user_teacher;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// $factory->define(user_student::class, function (Faker $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//         'remember_token' => Str::random(10),
//     ];
// });


$factory->define(user_teacher::class, function (Faker $faker) {
    return [

    	't_id' => $faker->unique()->randomNumber,
    	't_ref_id' => $faker->randomDigit,
        't_fname' => $faker->name,
        't_mname' => $faker->name,
        't_surname' => $faker->name,
        't_dob' => $faker->date,
        't_age' => $faker->randomDigit,
        't_email' => $faker->unique()->safeEmail,
        't_gender' => $faker->randomLetter,
       // 'email_verified_at' => now(),
        't_religion' => $faker->word,

        't_contact' => $faker->randomDigit,
        't_nationality' => $faker->country,
        't_address' => $faker->address,
        't_address_pin' => $faker->randomDigit,
        't_address_state' => $faker->city,
        't_sub' => $faker->word,
        'status' => $faker->randomDigit,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        't_authentication' => 1,
    ];
});



$factory->define(forum_thread::class, function ($faker) {
    $title = $faker->sentence;

    return [
        'user_id' => function () {
            return factory('App\Models\teacher\user_teacher')->create()->t_id;
        },
        'forum_channel_id' => function () {
            return factory('App\Models\forum\forum_channel')->create()->id;
        },
        'title' => $title,
        'body'  => $faker->paragraph,
       // 'visits' => 0,
        'slug' => str_slug($title),
       // 'locked' => false
        't_authentication' => 1,
        't_ref_id' => $faker->randomDigit,


    ];
});


$factory->define(App\Models\forum\forum_channel::class, function ($faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => $name,
        't_ref_id' => $faker->randomDigit,

    ];
});


$factory->define(App\Models\forum\forum_Reply::class, function ($faker) {
    return [
        'forum_thread_id' => function () {
            return factory('App\Models\forum\forum_thread')->create()->id;
        },
        'user_id' => function () {
            return factory('App\Models\teacher\user_teacher')->create()->t_id;
        },
        'body'  => $faker->paragraph,
        't_authentication' => 1,
        't_ref_id' => $faker->randomDigit,
        
    ];
});

$factory->define(user_student::class, function (Faker $faker) {
    return [

        's_id' => $faker->unique()->randomNumber,
        't_ref_id' => $faker->randomDigit,
        's_fname' => $faker->name,
        's_mname' => $faker->name,
        's_surname' => $faker->name,
        's_dob' => $faker->date,
        's_age' => $faker->randomDigit,
        's_email' => $faker->unique()->safeEmail,
        's_gender' => $faker->randomLetter,
       // 'email_verified_at' => now(),
        's_contact' => $faker->randomDigit,
        's_religion' => $faker->word,
        's_nationality' => $faker->country,
        's_address' => $faker->address,
        's_address_pin' => $faker->randomDigit,
        's_address_state' => $faker->city,
        'guardian_fname' => $faker->name,
        'guardian_mname' => $faker->name,
        'guardian_surname' => $faker->name,
        'guardian_address' => $faker->address,
        'guardian_pin' => $faker->randomDigit, 
        'guardian_email' => $faker->unique()->safeEmail,
        'guardian_contact' => $faker->randomDigit,
        'guardian_state' => $faker->city,
        'class_id' => $faker->randomNumber,
        //'status' => $faker->randomDigit,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        's_authentication' => 1,
    ];
});