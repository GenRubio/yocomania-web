<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigosPromocionale extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'oro',
        'user_id'
    ];
}
