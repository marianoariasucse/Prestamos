<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Penalizacion;

class PagoController extends Controller
{
    public function edit($id)
    {
        $pago = Pago::find($id);
        return view('pagos.edit', compact('pago'));
    }

    public function update(Request $request, $id)
{
    $porcentaje_penalizacion = $request->penalizacion;

    $pago = Pago::findOrFail($id);

    // Verificar si hay penalización antes de continuar
    if ($porcentaje_penalizacion > 0) {
        $penalizacion = new Penalizacion();
        $penalizacion->pago_id = $pago->id;
        $penalizacion->monto = $pago->monto * $porcentaje_penalizacion / 100;
        $penalizacion->save();
    }

    $pago->fecha_pago = $request->input('fecha_pago');
    $pago->pagado = true;
    $pago->save();

    return redirect()->route('prestamos.show', $pago->prestamo_id);
}

}
