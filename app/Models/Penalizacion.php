<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalizacion extends Model
{
    use HasFactory;

    protected $table = 'penalizaciones';

    protected $fillable = [
        'pago_id',
        'monto',
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
}
