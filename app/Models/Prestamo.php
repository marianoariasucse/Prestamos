<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto_prestado',
        'cliente_dni',
        'monto_ha_pagar',
        'cuotas',
        'interes',
        'fecha',
    ];

    protected $table = 'prestamos';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_dni', 'dni');
    }
}
