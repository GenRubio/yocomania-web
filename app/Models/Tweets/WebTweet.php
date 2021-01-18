<?php

namespace App\Models\Tweets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebTweet extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'tweet',
        'likes',
    ];
}
