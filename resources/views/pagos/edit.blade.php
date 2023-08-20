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
            <div class="mb-3">
                <input type="checkbox" id="pagado_checkbox">
                <label for="pagado" class="mb-3">¿Fuera de Termino?</label>
                <div id="penalizacion_div" style="display: none;">
                    <label for="penalizacion">% Penalización:</label>
                    <input type="number" name="penalizacion" id="penalizacion" class="form-control" value="0">
                    <p id="monto_penalizacion">Penalización: $0.00</p> <!-- Agregamos el elemento para mostrar el monto de la penalización -->
                </div>
                <p class="font-weight-bold">Total a pagar: $<span id="total_pagar">{{ $pago->monto }}</span></p>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <script>
        // Obtén el checkbox, el div y el campo de penalización
        var pagadoCheckbox = document.getElementById('pagado_checkbox');
        var penalizacionDiv = document.getElementById('penalizacion_div');
        var penalizacionInput = document.getElementById('penalizacion');
        var totalPagarSpan = document.getElementById('total_pagar');
        var montoPenalizacion = document.getElementById('monto_penalizacion');

        // Agrega un evento de cambio al checkbox
        pagadoCheckbox.addEventListener('change', function() {
            // Si el checkbox está marcado, muestra el div; de lo contrario, ocúltalo
            if (pagadoCheckbox.checked) {
                penalizacionDiv.style.display = 'block';
            } else {
                penalizacionDiv.style.display = 'none';
                penalizacionInput.value = 0; // Restaura el valor de penalización a 0
            }
            actualizarTotalAPagar(); // Llama a la función para actualizar el total a pagar
        });

        // Agrega un evento de entrada al campo de penalización
        penalizacionInput.addEventListener('input', function() {
            actualizarTotalAPagar(); // Llama a la función para actualizar el total a pagar
        });

        // Función para actualizar el total a pagar y el monto de la penalización
        function actualizarTotalAPagar() {
            var monto = parseFloat('{{ $pago->monto }}');
            var penalizacion = parseFloat(penalizacionInput.value);
            var montoPenalizacionCalculado = monto * (penalizacion / 100);
            var totalPagar = monto + montoPenalizacionCalculado;
            totalPagarSpan.textContent = totalPagar.toFixed(2);
            montoPenalizacion.textContent = "Penalización: $" + montoPenalizacionCalculado.toFixed(2); // Actualizamos el monto de la penalización
        }
    </script>
@endsection
