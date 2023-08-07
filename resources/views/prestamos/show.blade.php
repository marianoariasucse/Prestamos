@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="mb-3">
            <h3 class="mb-3 mt-2">Datos del Prestamo</h3>
            <p><strong>Cliente:</strong> {{ $prestamo->cliente_dni }} - {{ $prestamo->cliente->nombre }}</p>
            <p><strong>Fecha:</strong> {{ $prestamo->fecha }}</p>
            <p><strong>Monto Prestado:</strong> ${{ $prestamo->monto_prestado }}</p>
            <p><strong>Cuotas:</strong> {{ $prestamo->cuotas }}</p>
            <p><strong>Interes:</strong> {{ $prestamo->interes }}%</p>
            <p><strong>Total a pagar:</strong> ${{ $prestamo->monto_ha_pagar }}</p>
        </div>
        <hr class="hr hr-blurry" />
        <div>
            <h3 class="mb-3">Listado de Pagos</h3>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Monto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr>
                            <td>${{ $pago->monto }}</td>
                            <td>{{ $pago->estado ?? 'No pagado' }}</td>
                            <td>{{ $pago->fecha_pago ?? '-' }}</td>
                    @endforeach
                </tbody>
        </div>
    </div>
@endsection