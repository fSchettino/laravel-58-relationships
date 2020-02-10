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

Route::get('/', function () {
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
