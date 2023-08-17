@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1 class="mb-3">Registrar Pago</h1>
        <p class="mb-3"><strong>Cliente</strong> {{ $pago->cliente->nombre }}</p>
        <p class="mb-3"><strong>Monto</strong> ${{ $pago->monto }}</p>
        <form method="POST" action="{{ route('pagos.update', $pago->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="fecha_pago">Fecha:</label>
                <input type="date" name="fecha_pago" id="fecha_pago" class="form-control"
                    value="{{ now()->toDateString() }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
@endsection
