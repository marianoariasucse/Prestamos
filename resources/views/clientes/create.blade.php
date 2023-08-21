@extends('adminlte::page')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 class="mb-3 mt-2">Crear Cliente</h2>
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="dni">DNI: <span id="red">*</span></label>
                <input type="number" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre y Apellido: <span id="red">*</span></label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" id="telefono" class="form-control">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control">
            </div>
            <div class="form-group">
                <span id="red">*</span> Campos Obligatorios
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <style scoped>
        #red {
            color: red;
        }
    </style>
@endsection
