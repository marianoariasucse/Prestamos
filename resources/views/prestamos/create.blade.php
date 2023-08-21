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
                <label>Fecha de Otorgacion</label>
                <input type="date" name="fecha" id="fechs" class="form-control" value="{{ now()->toDateString() }}"
                    required>
            </div>
            <!-- Eliminamos el campo 'monto_ha_pagar' ya que se calcula automáticamente -->
            <div class="form-group">
                <label>Monto Total a Pagar:</label>
                <span id="montoTotal"></span>
                <!-- Agregamos un campo oculto para enviar el monto calculado al servidor -->
                <input type="hidden" name="monto_ha_pagar" id="monto_ha_pagar">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script>
        function calcularMontoTotal() {
            const montoPrestado = parseFloat(document.getElementById('monto_prestado').value);
            const cuotas = parseInt(document.getElementById('cuotas').value);
            const intereses = parseFloat(document.getElementById('interes').value);

            if (!isNaN(montoPrestado) && !isNaN(cuotas) && !isNaN(intereses)) {
                const montoTotal = montoPrestado + (montoPrestado * (intereses / 100));
                document.getElementById('montoTotal').textContent =
                    `$${montoTotal.toFixed(2)}, en ${cuotas} cuotas de $${(montoTotal / cuotas).toFixed(2)}`;

                // Actualizamos el valor del campo oculto 'monto_ha_pagar'
                document.getElementById('monto_ha_pagar').value = montoTotal.toFixed(2);
            } else {
                document.getElementById('montoTotal').textContent = "";
            }
        }

        document.getElementById('monto_prestado').addEventListener('input', calcularMontoTotal);
        document.getElementById('cuotas').addEventListener('input', calcularMontoTotal);
        document.getElementById('interes').addEventListener('input', calcularMontoTotal);

        // Llamar a la función inicialmente
        calcularMontoTotal();
    </script>
@endsection
