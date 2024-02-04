<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getResults(Request $request): JsonResponse
    {
        $start = microtime(true);
        /**
         * Your task is to return real data in this method.
         * Your implementation should focus on being fast, even as the tables get bigger (think 10.000+ users, 10.000+ movies, 1.000.000+ ratings).
         * Movies have multiple genres attached to them. Users also have genres that they have selected to be relevant for them.
         * This method should take the user's search query as a GET parameter and find the first 10 matching movies. For each movie return:
         *  - title in the user's language
         *  - release year
         *  - the average of all the movie's ratings
         *  - the median of all the movie's ratings
         *
         * In addition, movies are only visible to users if:
         *  - the movie is visible
         *  - the movie is available in the user's language
         *  - the title of the movie in the user's language contains the search query
         *  - the intersection of the movie's genres and the user's genres is bigger than 0
         * In order to keep this project simple, we have set up a $userData array that contains the data of the currently logged-in user. Please treat it as being dynamic, e.g. as if it could contain any valid data.
         *
         * This is the db structure you can expect:
         *  movies:
         *    - id
         *    - is_visible
         *    - created_at
         *    - updated_at
         *  movie_translations:
         *    - movie_id
         *    - language
         *    - title
         *    - release_year
         *    - poster
         *    - created_at
         *    - updated_at
         *   movie_ratings:
         *    - id
         *    - movie_id
         *    - user_id
         *    - rating (this is of type int)
         *    - rating_text (this is of type text)
         *   genres:
         *    - id
         *    - name
         *  movie_genres:
         *    - id
         *    - movie_id
         *    - genre_id
         *  user_genres:
         *    - id
         *    - user_id
         *    - genre_id
         */
        $userData = [
            'id' => 4,
            'language' => 'en',
        ];
        $results = [];
        $user = User::find($userData['id']);
        $query = $request->get('query');
        if (strlen(trim($query)) !== 0) {
            $results = Movie::search($query,$userData['language'],$user->genres->pluck('genre_id')->toArray());
        }

//        $results = [
//            [
//                'title' => 'Pulp Fiction',
//                'year' => 1994,
//                'avg_rating' => 9.9,
//                'median_rating' => 9.8,
//            ],
//        ];

        return response()->json(['results' => $results, 'exec_time' => microtime(true) - $start]);
    }
}
