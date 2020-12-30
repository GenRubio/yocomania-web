<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebEvento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'titulo',
        'alias',
        'descripcion',
        'fecha',
        'link',
        'tipo',
        'color',
        'image',
        'user_id',
        'active'
    ];
}
