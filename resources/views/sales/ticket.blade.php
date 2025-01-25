@extends('layouts.app')

@section('content')
    <title>Ticket de Compra</title>
    <style>
        .ticket-image {
            max-width: 200px; /* Ajusta el ancho máximo según tus necesidades */
            height: auto; /* La altura se ajustará de manera proporcional */
            display: block;
            /* margin: 0 auto; Centrar la imagen horizontalmente */
        }
    </style>
<body>
    <img class = ticket-image src="{{asset($sale->subsidiary->logo)}}" alt="Logo" class="img-fluid">
    <div class="ticket">
        <label><strong>Befit Sport Gym</strong></label>
        <p>{{$sale->subsidiary->address }}</p>
        <p>{{$sale->subsidiary->zip_code }}</p>
        <p>{{$sale->subsidiary->phone_number }}</p>
        <p>Fecha: {{ $sale->sale_date }}</p>
        @if(isset($client))
        <p>Nombre del cliente: </p>
        <p>{{$client->name.' '.$client->last_name.' '.$client->last_name_two}}</p>
        <p>Clave: </p>
        <p>{{$client->id}}</p>
        @endif
        <p>Tipo de Pago: {{ __('web.'.$sale->payment_type) }}</p>
        <table>
             <thead>
                <tr>
                    <th style = "text-align: center;" >Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($saleDetails as $saleDetail)
                <tr>
                    <td>{{ $saleDetail->product ? $saleDetail->product->name : $saleDetail->service->name }}</td>
                    <td>{{ $saleDetail->amount }}</td>
                    <td>${{ $saleDetail->price }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">------------------------------------</td>
                </tr>
                <tr>
                    @if(!$sale->totalCard)
                        <td colspan="2"><strong>Total:</strong></td>
                        <td>${{ $sale->total }}</td>
                    @else
                        <td colspan="2"><strong>Total Efectivo:</strong></td>
                        <td>${{ $sale->total - $sale->total_card }}</td>
                        <tr>
                            <td colspan="2"><strong>Total tarjeta:</strong></td>
                            <td>${{ $sale->total_card }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">------------------------------------</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Total:</strong></td>
                            <td>${{ $sale->total }}</td>
                        </tr>
                    @endif
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="ticket">

        <a href=# id="printButton" class="btn btn-primary mt-3">Imprimir</a>
        <a href="{{ route('welcome') }}" class="btn btn-secondary mt-3">Volver</a>

    </div>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            var ticketContents = document.querySelector('.ticket').innerHTML;
            var printWindow = window.open('', '_blank', 'width=600,height=600');
            const logoURL = "{{ asset($sale->subsidiary->logo) }}";
            printWindow.document.open();
            printWindow.document.write(`<img src="${logoURL}" alt="Logo" style="max-width: 175px;"/>`);
            printWindow.document.write(`<br>`);
            printWindow.document.write('<html><head><title>Ticket de Compra</title></head><body>');
            printWindow.document.write(ticketContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
</body>
</html>
@endsection
