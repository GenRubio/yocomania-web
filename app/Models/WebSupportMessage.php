<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSupportMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_usuario',
        'fecha',
        'subject',
        'contenido',
        'visto',
    ];
}
