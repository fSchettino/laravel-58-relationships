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

Route::get('/role', function () {
    $user = \App\User::first();
    //$roles = \App\Role::all();

    // Insert rows in the pivot table role_user
    //$user->roles()->attach($roles); // Attach all roles for given user
    //$user->roles()->attach([1, 3, 5]); // Attach certain roles for given user using an array of roles id

    // Delete all previous relation rows and set relations for role values in the array
    //$user->roles()->sync([4, 5]); (sync method detach all previous registered entries before adding a new ones)

    //$role = \App\Role::find(1);
    //$role->users()->sync([4, 2]); (using user relation on role)

    // Add a new relation row without delete existing ones
    //$user->roles()->syncWithoutDetaching([1]); (syncWithoutDetaching method add a new one without detach all previous registered entries)
    //$role->users()->syncWithoutDetaching([1]); (using user relation on role)

    // Insert rows in the pivot table role_user
    //$user2 = \App\User::find(2);
    //$user2->roles()->attach($roles);

    // Delete row from pivot table
    //$role_delete = \App\Role::find(1);
    //$user2->roles()->detach($role_delete);

    // Adding data to pivot table name column
    /*$user->roles()->sync([
        1 => [
            'name' => 'John Doe'
        ]
    ]);*/

    // Retrieving additional data from pivot table declared in the model roles relation
    //dd($user->roles->first()->pivot);
    dd($user->roles->first()->pivot->name);
});
