<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        try {
            // Validación de datos
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'dni' => 'required|string|max:255|unique:clientes,dni',
                'email' => 'email|unique:clientes,email|nullable',
                'telefono' => 'string|max:255|nullable',
                'direccion' => 'string|max:255|nullable',
            ]);
        
            $cliente = Cliente::create(array_merge($validatedData, ['user_id' => auth()->user()->id]));
        
            return redirect()->route('clientes.show', $cliente);
        } catch (Illuminate\Validation\ValidationException $e) {
            // Mostrar los errores al usuario
            return redirect()->back()->withErrors($e->errors());
        }
    }   

    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('clientes.show', ['cliente' => $cliente]);
    }
}
