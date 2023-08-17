@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="mb-3">
            <h3 class="mb-3">Datos del Prestamo</h3>
            <p><strong>Cliente: </strong>{{ $prestamo->cliente->nombre }} - {{$prestamo->cliente->dni  }}</p>
            <p><strong>Fecha:</strong> {{ $prestamo->fecha }}</p>
            <p><strong>Monto Prestado:</strong> ${{ $prestamo->monto_prestado }}</p>
            <p><strong>Cuotas:</strong> {{ $prestamo->cuotas }}</p>
            <p><strong>Interes:</strong> {{ $prestamo->interes }}%</p>
            <p><strong>Total a pagar:</strong> ${{ $prestamo->monto_ha_pagar }}</p>
            <hr class="hr hr-blurry mt-2 mb-2" />
        </div>
        <div>
            <h3 class="mb-3">Listado de Pagos</h3>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de Pago</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr>
                            <th scope="row">{{ $pago->id }}</th>
                            <td>${{ $pago->monto }}</td>
                            <td>
                                @if ($pago->pagado)
                                    <span class="badge badge-success">Pagado</span>
                                @else
                                    <span class="badge badge-danger">Pendiente</span>
                                @endif
                            </td>
                            <td>{{ $pago->fecha_pago ?? '-' }}</td>
                            <td>
                                @if (!$pago->pagado)
                                    <button class="btn btn-primary p-1">
                                        <a href="{{ route('pagos.edit', $pago->id) }}" class="text-white">Registrar</a>
                                    </button>
                                @endif
                            </td>
                    @endforeach
                </tbody>
        </div>
    </div>

    <style>
        @media (min-width: 768px) {
            .container {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .hr-blurry {
                display: block;
            }
        }

        .hr-blurry {
            display: none;
        }
    </style>
@endsection
