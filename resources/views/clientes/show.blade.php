@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="mb-3">
            <h3 class="mb-3 mt-2">Datos Personales</h3>
            <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Telefono:</strong> {{ $cliente->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
        </div>
        <div>
            <h3>Historial de Pagos</h3>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Penalizacion</th>
                            <th scope="col">Fecha de Pago</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr class="{{ $pago->pagado ? 'bg-teal' : '' }}">
                                <th scope="row">{{ $pago->id }}</th>
                                <td>${{ $pago->monto }}</td>
                                <td>
                                    @foreach ($penalizaciones as $penalizacion)
                                        @if ($penalizacion->pago_id === $pago->id)
                                            ${{ $penalizacion->monto }}
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $pago->fecha_pago ?? '-' }}</td>
                            <td>
                                @if (!$pago->pagado)
                                    <button class="btn btn-primary p-1">
                                        <a href="{{ route('pagos.edit', $pago->id) }}" class="text-white">Registrar</a>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection
