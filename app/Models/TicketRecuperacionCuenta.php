<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketRecuperacionCuenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'usuario_nombre',
        'nombre',
        'password',
        'clave',
    ];
}
