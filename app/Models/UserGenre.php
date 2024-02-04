<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGenre extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
