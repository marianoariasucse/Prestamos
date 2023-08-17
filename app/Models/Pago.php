<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_dni',
        'prestamo_id',
        'monto',
        'fecha_pago',
    ];

    protected $table = 'pagos';


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_dni', 'dni');
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }

    protected $casts = [
        'estado' => 'boolean',
    ];

}
