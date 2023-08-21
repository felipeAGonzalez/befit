@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Ventas</h1>

    <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Fecha de venta</th>
            <th>Total</th>
            <!-- Agrega más columnas aquí -->
        </tr>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->sale_date }}</td>
            <td>{{ $sale->total }}</td>
            <!-- Mostrar más atributos aquí -->
        </tr>
        @endforeach
    </table>
</div>
@endsection

