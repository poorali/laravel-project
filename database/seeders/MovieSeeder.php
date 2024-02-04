<?php

namespace Database\Seeders;

use App\Jobs\MovieRatingJob;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\MovieRating;
use App\Models\MovieTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Movie::factory(10000)->create()->each(function($movie){
//            print_r('movie => '. $movie->id."\n");
//            MovieTranslation::factory(3)->create(['movie_id' => $movie->id]);
//            MovieGenre::factory(3)->create(['movie_id' => $movie->id]);
//        });
        for ($i=0;$i<100;$i++){
            print_r('Reviews =>' . $i. "\n");
            MovieRatingJob::dispatch();
        }

    }
}
