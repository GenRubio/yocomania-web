<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BpadAmigo extends Model
{
    use HasFactory;
    protected $fillable = [
        'ID_1',
        'Nota',
        'Marquilla',
        'ID_2',
        'Solicitud',
    ];
}
