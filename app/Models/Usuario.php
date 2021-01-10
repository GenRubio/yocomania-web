<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Usuario extends Authenticable
{
    use HasFactory;
    use Billable;
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
