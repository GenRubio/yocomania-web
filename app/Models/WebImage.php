<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'link',
        'tipo',
        'active',
        'created_at',
    ];
}
