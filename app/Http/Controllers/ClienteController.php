<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        Cliente::create([
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('clientes.show', ['id' => Cliente::all()->last()->id]);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('clientes.show', ['cliente' => $cliente]);
    }
}
