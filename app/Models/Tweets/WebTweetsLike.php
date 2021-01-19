<?php

namespace App\Models\Tweets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebTweetsLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'tweet_id',
        'usuario_id',
    ];
}
