<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{

    public function index()
    {
        $user = auth()->user()->id;

        $prestamos = Prestamo::all();

        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        return view('prestamos.create');
    }

    public function store(Request $request)
    {
        $prestamo = new Prestamo();
        $prestamo->cliente_dni = $request->cliente_dni;
        $prestamo->monto_prestado = $request->monto_prestado;
        $prestamo->monto_ha_pagar = $request->monto_prestado + ($request->monto_prestado * $request->interes / 100);
        $prestamo->cuotas = $request->cuotas;
        $prestamo->interes = $request->interes;
        $prestamo->fecha = $request->fecha;
        $prestamo->save();

        for($i = 0; $i < $prestamo->cuotas; $i++) {
            $pago = new Pago();
            $pago->cliente_dni = $request->cliente_dni;
            $pago->prestamo_id = $prestamo->id;
            $pago->monto = $prestamo->monto_ha_pagar / $prestamo->cuotas;
            $pago->save();
        }

        return redirect()->route('prestamos.show', $prestamo->id);
    }

    public function show($id)
    {
        $user = auth()->user()->id;

        $prestamo = Prestamo::findOrFail($id);

        $pagos = Pago::where('prestamo_id', $id)->get();

        return view('prestamos.show', compact('prestamo', 'pagos'));
    }
}
