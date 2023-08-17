<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;

class PagoController extends Controller
{
    public function edit($id)
    {
        $pago = Pago::find($id);
        return view('pagos.edit', compact('pago'));
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::find($id);
        $pago->fecha_pago = $request->input('fecha_pago');
        $pago->pagado = true;
        $pago->save();

        return redirect()->route('prestamos.show', $pago->prestamo_id);        
    }


}
