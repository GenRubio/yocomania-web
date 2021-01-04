<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetosComprado extends Model
{
    use HasFactory;
    protected $fillable = [
        'objeto_id',
        'posX',
        'posY',
        'colores_hex',
        'colores_rgb',
        'rotation',
        'tam',
        'espacio_ocupado',
        'sala_id',
        'data',
        'contador',
        'usuario_id',
        'planta_agua',
        'planta_sol',
        'id_objeto_2',
        'open',
        'active',
    ];
}
