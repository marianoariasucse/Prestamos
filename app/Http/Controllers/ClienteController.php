<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\Penalizacion;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::where('user_id', auth()->user()->id)->get();

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
                'dni' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('clientes', 'dni')->where(function ($query) {
                        return $query->where('user_id', auth()->user()->id);
                    }),
                ],
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
        $cliente = Cliente::where('user_id', auth()->user()->id)->findOrFail($id);

        $pagos = Pago::where('cliente_dni', $cliente->dni)->orderBy('id', 'desc')->get();

        $penalizaciones = Penalizacion::whereIn('pago_id', $pagos->pluck('id'))->get();

        return view('clientes.show', compact('cliente', 'pagos', 'penalizaciones'));
    }
}
