<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $data = file_get_contents($faker->image($dir = 'public/tmp', $width = 640, $height = 420));
    $base64 = 'data:image/jpg;base64,' . base64_encode($data);
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'image' => $base64
    ];
});
