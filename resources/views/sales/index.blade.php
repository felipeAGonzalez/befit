@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Ventas</h1>

    <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>
    <div class="table-responsive">
    <table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Fecha de venta</th>
            <th>Tipo de Pago</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->sale_date }}</td>
            <td>{{ __('web.'.$sale->payment_type) }}</td>
            <td>{{ $sale->total }}</td>
            <td>
                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('sales.ticket', $sale->id) }}" class="btn btn-primary">Reimprimir</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end">
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            {!!$sales->links()!!}
            </ul>
        </nav>
    </div>
</div>
@endsection

