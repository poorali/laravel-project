<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

trait HasCache
{
    //Cache DB Function response for better performance
    public static function useCache($callback, $key, $expireTime = 10)
    {
        $response = Cache::get($key);
        if (!$response) {
            $response = $callback();
            Cache::put($key, $response, Carbon::now()->addMinutes($expireTime));
        }
        return $response;
    }
}
