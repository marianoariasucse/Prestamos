@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1 class="mb-3">Clientes</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td>DNI</td>
                        <td>Nombre</td>
                        <td>Email</td>
                        <td>Telefono</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->dni }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefono }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
@endsection