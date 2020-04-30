<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Action;
use Faker\Generator as Faker;

$factory->define(Action::class, function (Faker $faker) {
    return [
        'action' => $faker->name,
        'user_id' => function(){
            return factory('App\User')->create()->id;
        }
    ];
});
