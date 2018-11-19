<?php

use Faker\Generator as Faker;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(User::class,'admin', function (Faker $faker) {
    return [
        'name' => 'admin',
        'email' => 'admin@mail.com',
        'email_verified_at' => now(),
        'password' => '123456', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(Role::class,'role', function (Faker $faker) {
    return [
        'name' => 'admin',
        'guard_name'=>'web'
    ];
});

$factory->defineAs(Permission::class,'permission_users', function (Faker $faker) {
    return [
        'name' => 'users',
        'alias' => 'Сотрудники',
        'guard_name' => 'web'
    ];
});

$factory->defineAs(Permission::class,'permission_roles', function (Faker $faker) {
    return [
        'name' => 'roles',
        'alias' => 'Должности',
        'guard_name' => 'web'
    ];
});