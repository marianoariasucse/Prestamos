<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Penalizacion;
use Illuminate\Support\Facades\DB;
use App\Models\Prestamo;

class PagoController extends Controller
{
    public function edit($id)
    {
        $pago = Pago::find($id);
        return view('pagos.edit', compact('pago'));
    }

    public function update(Request $request, $id)
    {
        $porcentaje_penalizacion = $request->input('penalizacion', 0); // Asumiendo un valor predeterminado de 0 si no se proporciona

        try {
            DB::beginTransaction(); // Iniciar una transacción

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

            // Contar los pagos pagados y totales en una sola consulta
            $pagos_pagados = Pago::where('prestamo_id', $pago->prestamo_id)
            ->where('pagado', true)
            ->count();

            $pagos_totales = Pago::where('prestamo_id', $pago->prestamo_id)
                ->count();

                if ($pagos_pagados === $pagos_totales) {
                    $prestamo = Prestamo::findOrFail($pago->prestamo_id);
                    $prestamo->pagado = true;
                    $prestamo->save();
                }
                

            DB::commit(); // Confirmar la transacción
        } catch (Exception $e) {
            DB::rollback(); // En caso de error, revertir la transacción
            // Manejar el error adecuadamente, por ejemplo, redirigir a una página de error o mostrar un mensaje al usuario
        }

        return redirect()->route('prestamos.show', $pago->prestamo_id);

    }

}
