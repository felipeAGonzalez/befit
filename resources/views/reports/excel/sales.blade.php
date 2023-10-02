<div class="col-md-6">
                <h3>Gastos</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Descripción</th>
                            <th>Turno</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Expenses as $expense)
                            <tr>
                                <td>{{ $expense->subsidiary->name }}</td>
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->shift }}</td>
                                <td>{{ $expense->date->format('d-m-Y') }}</td>
                                <td>${{ $expense->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table>
                    <tr>
                        <th>Total de gastos</th>
                    </tr>
                    <tr>
                        <td> $ {{number_format($ExpensesTotal,2)}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h3>Ventas</h3>
                <table class="table">
    <thead>
        <tr>
            <th>No de la nota</th>
            <th>Fecha</th>
            <th>Producto/Servicio</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
    @foreach($salesDetails as $saleDetail)
        <tr>
            <td>{{ $saleDetail->sale_id }}</td>
            <td>{{ $saleDetail->sale->sale_date->format('Y-m-d') }}</td>
            <td>{{ $saleDetail->product ? $saleDetail->product->name : $saleDetail->service->name }}</td>
            <td>{{ $saleDetail->amount }}</td>
            <td>${{ $saleDetail->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
                <table>
                    <tr>
                        <th>Total de ventas</th>
                    </tr>
                    <tr>
                        <td> $ {{number_format($SalesTotal,2)}}</td>
                    </tr>
                </table>
            </div>
