<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    protected $fillable = [
        'dni',
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'cliente_dni', 'dni');
    }
}
