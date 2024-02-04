<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserGenre;
use Database\Factories\UserGenreFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(10000)->create()->each(function($user) {
            print_r('user => '. $user->id."\n");
            UserGenre::factory(3)->for($user)->create();
        });
    }
}
