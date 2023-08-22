@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1 class="mb-3">Clientes</h1>
        <div class="mb-3">
            <input type="text" class="form-control" name="" id="searchInput" aria-describedby="helpId"
                placeholder="Buscar">
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td>DNI</td>
                        <td>Nombre</td>
                        <td>Telefono</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->dni }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>
                            <button class="btn btn-primary">
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="text-white">Ver</a>
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