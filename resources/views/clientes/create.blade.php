@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2 class="mb-3 mt-2">Crear Cliente</h2>
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="number" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" id="telefono" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="direccion">Dirección:</label>
              <input type="text" name="direccion" id="direccion" class="form-control" required>
          </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
