@extends('adminlte::page')

@section('content')
    <div class="container">
        <h3 class="mb-3 mt-2">Datos Personales</h3>
        <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
        <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
        <p><strong>Email:</strong> {{ $cliente->email }}</p>
        <p><strong>Telefono:</strong> {{ $cliente->telefono }}</p>
        <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
    </div>
@endsection