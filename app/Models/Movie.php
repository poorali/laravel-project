<?php

namespace App\Models;

use App\Traits\HasCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    use HasCache;

    public function genres()
    {
        return $this->hasMany(MovieGenre::class);
    }

    public function ratings()
    {
        return $this->hasMany(MovieRating::class);
    }

    public function translations()
    {
        return $this->hasMany(MovieTranslation::class);
    }

    public static function search($query, $lang = 'en', $genres = [], $limit = 10)
    {
        $movies = self::useCache(function () use ($query, $lang, $genres, $limit) {
            return self::with(['translations', 'ratings'])
                ->isVisible()
                ->hasLangQuery($query, $lang)
                ->withGenres($genres)
                ->limit($limit)
                ->get();
        }, $query . $lang . implode('', $genres));

        return $movies->map(function ($movie) use ($lang, $genres) {
            $average = $movie->ratings->avg('rating') ?? 0;
            $median = $movie->ratings->median('rating') ?? 0;
            $translation = $movie->translations->where('language', $lang)->first();
            return [
                'movie_id' => $movie->id,
                'title' => $translation->title,
                'release_year' => $translation->title,
                'average_rating' => round($average,1),
                'median_rating' => round($median,1),
            ];
        });
    }

    public function scopeIsVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeHasLangQuery($query, $searchQuery, $lang)
    {
        return $query->whereHas('translations', function ($query) use ($searchQuery, $lang) {
            $query->where('language', $lang)
                ->where('title', 'like', "%$searchQuery%");
        });
    }

    public function scopeWithGenres($query, $genres)
    {
        return $query->whereHas('genres', function ($query) use ($genres) {
            $query->whereIn('genre_id', $genres);
        });
    }
}
