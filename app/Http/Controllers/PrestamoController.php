<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use App\Models\Cliente;

class PrestamoController extends Controller
{

    public function index()
    {
        $user = auth()->user()->id;

        $prestamos = Prestamo::where('user_id', $user)->get();

        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        return view('prestamos.create');
    }

    public function store(Request $request)
    {

        //create validations
        $validatedData = $request->validate([
            'cliente_dni' => 'required|string|max:8',
            'monto_prestado' => 'required|numeric',
            'monto_ha_pagar' => 'required|numeric',
            'cuotas' => 'required|numeric',
            'interes' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        //valida que el cliente exista
        $cliente = Cliente::where('dni', $request->cliente_dni)->where('user_id', auth()->user()->id)->first();
        if (!$cliente) {
            return redirect()->back()->withErrors(['cliente_dni' => 'Cliente no registrado']);
        }

        //crea el prestamo
        $prestamo = new Prestamo();
        $prestamo->fill($validatedData);
        $prestamo->user_id = auth()->user()->id;
        $prestamo->save();

        //crea los pagos
        $pagos = collect();

        for ($i = 0; $i < $prestamo->cuotas; $i++) {
            $pago = new Pago();
            $pago->cliente_dni = $request->cliente_dni;
            $pago->prestamo_id = $prestamo->id;
            $pago->monto = $prestamo->monto_ha_pagar / $prestamo->cuotas;
            $pagos->push($pago);
    
            // Guarda el pago individual en la base de datos
            $pago->save();
        }

        return redirect()->route('prestamos.show', $prestamo->id);
    }

    public function show($id)
    {
        $user = auth()->user()->id;

        $prestamo = Prestamo::where('user_id', $user)->findOrFail($id);

        $pagos = Pago::where('prestamo_id', $id)->get();

        return view('prestamos.show', compact('prestamo', 'pagos'));
    }
}
