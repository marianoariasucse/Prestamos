@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="mb-3">
            <h1 class="mb-3">Prestamos Otorgados</h1>
            <div class="mb-3">
                <input type="text" class="form-control" name="" id="searchInput" aria-describedby="helpId"
                    placeholder="Buscar">
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
                        <tr>
                            <td>{{ $prestamo->cliente->nombre }} - {{ $prestamo->cliente->dni }}</td>
                            <td>${{ $prestamo->monto_prestado }}</td>
                            <td>{{ $prestamo->fecha }}</td>
                            <td>
                                <button class="btn btn-primary">
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
            const tableRows = document.querySelectorAll('.table tbody tr');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const rowData = row.textContent.toLowerCase();
                    row.style.display = rowData.includes(searchTerm) ? '' : 'none';
                });
            });
        });
    </script>
@endsection
