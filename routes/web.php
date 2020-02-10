<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Faker\Generator as Faker;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phone', function () {
    $user = factory(\App\User::class)->create();

    // Create a phone number for just created user (technique 1)
    /*$phone = new \App\Phone();
    $phone->phone = '123456789';
    $user->phone()->save($phone);*/

    // Create a phone number for just created user (technique 2- through relationship)
    $user->phone()->create([
        'phone' => '987654321'
    ]);
});

Route::get('/post', function (Faker $faker) {
    $user = factory(\App\User::class)->create();

    // Create a phone number for just created user (technique 1)
    /*$post = new \App\Post([
        'title' => $faker->sentence,
        'body' => $faker->text,
        'user_id' => $user->id
    ]);
    $post->save();*/

    // Create a post for just created user (technique 2- through relationship)
    $user->posts()->create([
        'title' => $faker->sentence,
        'body' => $faker->text
    ]);

    // Update created post
    $user->posts->first()->title = 'Updated post title';
    $user->posts->first()->body = 'Updated post body';
    // Pushing updates into relation automatically
    $user->push();
});
