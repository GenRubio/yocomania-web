<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticable
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'password',
        'avatar',
        'colores',
        'email',
        'edad',
        'oro',
        'plata',
        'ip_registro',
        'ip_actual',
        'fecha_registro',
        'security',
        'token',
        'active_token',
        'besos_enviados',
        'besos_recibidos',
        'Online',
    ];
}
