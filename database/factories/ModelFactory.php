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

$factory->define(App\User::class, function (Faker\Generator $faker) {
   return [
      'name' => $faker->name,
      'email' => $faker->email,
      'password' => app('hash')->make('password'),

   ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
   return [
      'title' => $faker->sentence,
      'message' => $faker->paragraph,
      'user_id' => function () {
         return factory(App\User::class)->create()->id;
      },
   ];
});
