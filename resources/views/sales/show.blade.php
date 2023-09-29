@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Detalles de la Venta</h2>
            <p><strong>Fecha: </strong>{{ $sale->sale_date->format('d-m-Y') }}</p>
                @if(isset($client))
                <p><strong>Nombre del cliente: </strong></p>
                <p>{{$client->name.' '.$client->last_name.' '.$client->last_name_two}}</p>
                @endif
                <p><strong> Tipo de Pago: {{ __('web.'.$sale->payment_type) }}</strong></p>

            <h3>Productos Vendidos</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($saleDetails as $saleDetail)
                <tr>
                    <td>{{ $saleDetail->id }}</td>
                    <td>{{ $saleDetail->product ? $saleDetail->product->name : $saleDetail->service->name }}</td>
                    <td>{{ $saleDetail->amount }}</td>
                    <td>${{ $saleDetail->price }}</td>
                    <td>${{ $saleDetail->price * $saleDetail->amount}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @if(!$sale->total_card)
                        <td></td>
                        <td></td>
                        <td colspan="2"><strong>Total:</strong></td>
                        <td>${{ $sale->total }}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td colspan="2"><strong>Total Efectivo:</strong></td>
                        <td>${{ $sale->total - $sale->total_card }}</td>
                        <tr>
                        <td></td>
                        <td></td>
                            <td colspan="2"><strong>Total tarjeta:</strong></td>
                            <td>${{ $sale->total_card }}</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td></td>
                            <td colspan="2"><strong>Total:</strong></td>
                            <td>${{ $sale->total }}</td>
                        </tr>
                    @endif
                </tr>
            </tfoot>
            </table>
        </div>
    </div>
</div>
    <div class="ticket">
        <a href="{{ route('sales.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection
