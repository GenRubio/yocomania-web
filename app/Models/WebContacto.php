<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebContacto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'subject',
        'contenido',
        'email',
    ];
}
