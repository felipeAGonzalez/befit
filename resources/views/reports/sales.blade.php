@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reporte de ventas</h2>
        <label for="date">Filtro de fechas:</label>
        <form action="{{ route('reports.sales') }}" method="GET" class="mb-3">
            <div class="input-group col-md-3">
                <input type="date" id="date" name="date" value="">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>
        <div class="col-md-3">
        <a href="{{ route('sales.excel') }}" class="btn btn-success">Excel</a>
        </div>
        <div class="row">
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
                        @foreach ($expenses as $expense)
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
                        <td> $ {{number_format($expensesTotal,2)}}</td>
                    </tr>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                    {!!$expenses->appends(request()->query())->links()!!}
                    </ul>
                </nav>
            </div>
            <div class="col-md-6">
                <h3>Ventas</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Turno</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->subsidiary->name }}</td>
                                <td>{{ $sale->shift }}</td>
                                <td>{{ $sale->sale_date->format('d-m-Y') }}</td>
                                <td>${{ $sale->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table>
                    <tr>
                        <th>Total de ventas</th>
                    </tr>
                    <tr>
                        <td> $ {{number_format($salesTotal,2)}}</td>
                    </tr>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                    {!!$sales->appends(request()->query())->links()!!}

                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="input-group col-md-3">
    <span><strong><label for="gains">Utilidad: </label></strong> $ {{number_format($salesTotal-$expensesTotal,2)}}</span>
    </div>
    <div class="container">
        <div id="salesExpensesChart" style="width: 100%; height: 600px;"></div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Type');
            data.addColumn('number', 'Amount');
            data.addRows([
                ['Ventas', {{ $salesTotal }}],
                ['Gastos', {{ $expensesTotal }}]
            ]);

            var options = {
                title: 'Gráfica Del reporte',
                pieHole: 0.4
            };

            var chart = new google.visualization.PieChart(document.getElementById('salesExpensesChart'));
            chart.draw(data, options);
        }
    </script>
@endsection
