@extends('adminlte::page')

@section('content')
    <div class="container">
      <div class="row justify-content-center d-flex align-items-center" style="height: 90vh">
        <div class="col-md-8">
            <h1 class="text-center font-weight-bold">Bienvenido {{ auth()->user()->name }}</h1>
        </div>
    </div>
    </div>
@endsection