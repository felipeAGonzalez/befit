@extends('layouts.app')

@section('content')
<div class="container">
<label for="date">Filtro de fechas:</label>
        <form action="{{ route('reports.subsidiaries') }}" method="GET" class="mb-3">
            <div class="input-group col-md-3">
                <input type="date" id="date" name="date" value="">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>
    @foreach ($subsidiaries as $subsidiary)
        <h2>Sucursal: {{ $subsidiary->name }}</h2>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="heading{{ $subsidiary->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-dark" data-toggle="collapse" data-target="#collapse{{ $subsidiary->id }}" aria-expanded="true" aria-controls="collapse{{ $subsidiary->id }}">
                            Mostrar Ventas
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $subsidiary->id }}" class="collapse" aria-labelledby="heading{{ $subsidiary->id }}" data-parent="#accordion">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Ventas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subsidiary->sales as $sale)
                                    <tr>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>${{ number_format($sale->total,2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Ventas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subsidiary->expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->date }}</td>
                                        <td>${{ number_format($expense->amount,2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <br>
    <div id="salesVsExpensesChart" style="width: 100%; height: 400px;"></div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sucursal');
        data.addColumn('number', 'Ventas');
        data.addColumn('number', 'Gastos');
        data.addRows([
            @foreach ($subsidiaries as $subsidiary)
                ['{{ $subsidiary->name }}', {{ $subsidiary->sales->sum('total') }}, {{ $subsidiary->expenses->sum('amount') }}],
            @endforeach
        ]);

        var options = {
            title: 'Ventas vs Gastos por Sucursal',
            hAxis: {
                title: 'Sucursal'
            },
            vAxis: {
                title: 'Cantidad'
            },
            seriesType: 'bars',
        };

        var chart = new google.visualization.ComboChart(document.getElementById('salesVsExpensesChart'));
        chart.draw(data, options);
    }
</script>

@endsection
