@extends('layouts.app')

@section('content')
    <title>Ticket de Compra</title>

<body>
    <div class="ticket">
        <h1>Ticket de Compra</h1>
        <p>Fecha: {{ $sale->sale_date }}</p>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
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
                    <td colspan="3">--------------------------</td>
                </tr>
                <tr>
                    <td colspan="2">Total:</td>
                    <td>${{ $sale->total }}</td>
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
            printWindow.document.open();
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
