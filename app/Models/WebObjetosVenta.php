<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebObjetosVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'objeto_id',
        'compra_id',
        'usuario_id',
        'oro',
        'plata',
    ];
}
