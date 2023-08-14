@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Ventas</h1>

    <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Producto</th>
            <!-- Agrega más columnas aquí -->
        </tr>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->cliente }}</td>
            <td>{{ $sale->producto }}</td>
            <!-- Mostrar más atributos aquí -->
        </tr>
        @endforeach
    </table>
</div>
@endsection

