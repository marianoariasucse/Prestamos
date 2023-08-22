@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="mb-3">
            <h1 class="mb-3">Prestamos Otorgados</h1>
            <div class="mb-3">
                <input type="text" class="form-control" name="" id="searchInput" aria-describedby="helpId"
                    placeholder="Buscar por Nombre">
            </div>
            <div>
                <select id="filterSelect" class="custom-select">
                    <option value="all">Todos</option>
                    <option value="pagados">Pagados</option>
                    <option value="no_pagados">No Pagados</option>
                </select>
            </div>
            <div class="mt-3">
                Desde: <input type="date" class="form-control" id="dateFrom">
                Hasta: <input type="date" class="form-control" id="dateTo">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Monto Prestado</th>
                        <th scope="col">Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prestamos as $prestamo)
                        <tr class="{{ $prestamo->pagado ? 'bg-teal' : '' }}">
                            <td>{{ $prestamo->cliente->nombre }} - {{ $prestamo->cliente->dni }}</td>
                            <td>${{ $prestamo->monto_prestado }}</td>
                            <td>{{ $prestamo->fecha }}</td>
                            <td>
                                <button class="btn p-1 {{ $prestamo->pagado ? 'bg-light' : 'btn-primary' }}">
                                    <a href="{{ route('prestamos.show', $prestamo->id) }}" class="text-white">Ver</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterSelect = document.getElementById('filterSelect');
            const dateFromInput = document.getElementById('dateFrom');
            const dateToInput = document.getElementById('dateTo');
            const tableRows = document.querySelectorAll('.table tbody tr');

            // Establecer valores predeterminados para "Desde" y "Hasta"
            const today = new Date();
            const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

            dateFromInput.valueAsDate = firstDayOfMonth;
            dateToInput.valueAsDate = today;

            function applyFilters() {
                const searchTerm = searchInput.value.toLowerCase();
                const filterValue = filterSelect.value;
                const dateFrom = dateFromInput.value;
                const dateTo = dateToInput.value;

                tableRows.forEach(row => {
                    const rowData = row.textContent.toLowerCase();
                    const isPagado = row.classList.contains('bg-teal');
                    const fechaPrestamo = row.querySelector('td:nth-child(3)').textContent;

                    const matchesSearch = rowData.includes(searchTerm);
                    const matchesFilter = (filterValue === 'all' || (filterValue === 'pagados' && isPagado) || (filterValue === 'no_pagados' && !isPagado));
                    const matchesDate = (!dateFrom || fechaPrestamo >= dateFrom) && (!dateTo || fechaPrestamo <= dateTo);

                    if (matchesSearch && matchesFilter && matchesDate) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', applyFilters);
            filterSelect.addEventListener('change', applyFilters);
            dateFromInput.addEventListener('input', applyFilters);
            dateToInput.addEventListener('input', applyFilters);

            // Aplicar los filtros iniciales
            applyFilters();
        });
    </script>
@endsection
