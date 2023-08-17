@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2 class="mb-3 mt-2">Generar Prestamo</h2>
        <form action="{{ route('prestamos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cliente_dni">DNI Cliente:</label>
                <div class="d-flex gap-3">
                    <input type="number" name="cliente_dni" id="cliente_dni" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="monto_prestado">Monto Prestado:</label>
                <input type="number" name="monto_prestado" id="monto_prestado" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cuotas">Cantidad de Cuotas:</label>
                <input type="number" name="cuotas" id="cuotas" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="interes">% Interes:</label>
                <input type="number" name="interes" id="interes" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de Otorgacion:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Monto Total a Pagar: <span id="montoTotal"></span></label>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <script>
                function calcularMontoTotal() {
                    const montoPrestado = parseFloat(document.getElementById('monto_prestado').value);
                    const cuotas = parseInt(document.getElementById('cuotas').value);
                    const intereses = parseFloat(document.getElementById('interes').value);

                    const montoTotal = montoPrestado + (montoPrestado * (intereses / 100));

                    document.getElementById('montoTotal').textContent = `$${montoTotal.toFixed(2)}, en ${cuotas} cuotas de $${(montoTotal / cuotas).toFixed(2)}`
                }

                document.getElementById('monto_prestado').addEventListener('change', calcularMontoTotal);
                document.getElementById('cuotas').addEventListener('change', calcularMontoTotal);
                document.getElementById('interes').addEventListener('change', calcularMontoTotal);

                if(!isNaN(parseFloat(document.getElementById('monto_prestado').value)) || !isNaN(parseInt(document.getElementById('cuotas').value)) || !isNaN(parseFloat(document.getElementById('interes').value)))
                    calcularMontoTotal();
            </script>
            <script src="{{ asset('js/components/BuscarCliente.jsx') }}"></script>
        </form>
    </div>
@endsection
