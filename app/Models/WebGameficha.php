<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebGameficha extends Model
{
    use HasFactory;
    protected $fillable = [
        'ficha_id',
        'nombreImg',
    ];
}
