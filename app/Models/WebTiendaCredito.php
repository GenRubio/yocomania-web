<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebTiendaCredito extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'precio',
        'nombre',
        'imagen',
        'descripcion',
    ];
}
