@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Ventas</h1>

    <div class="row">
        <div class="col-md-3">

            <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>
        </div>
        @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE')
                <div class="col-md-6">
                    <form action="{{ route('sale.search') }}" method="GET" class="mb-3">
                        <div class="input-group mb-3">
                        <div class="form-inline">
                            <select name="subsidiary_id" class="form-control mr-2" id="subsidiary_id">
                                <option value="" default>Seleccione una sucursal</option>
                                    @foreach($subsidiary as $key => $value)
                                        <option value="{{$value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <div>
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                    <a href="{{route('sales.index')}}" class="btn btn-info">Limpiar Filtro</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    <div class="table-responsive">
    <table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Fecha de venta</th>
            <th>Tipo de Pago</th>
            <th>Total</th>
            @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE')
                <th>Sucursal</th>
            @endif
            <th>Acciones</th>
        </tr>
    </thead>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->sale_date }}</td>
            <td>{{ __('web.'.$sale->payment_type) }}</td>
            <td>{{ $sale->total }}</td>
            @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE')
                <td>{{ $sale->subsidiary->name }}</td>
            @endif
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

