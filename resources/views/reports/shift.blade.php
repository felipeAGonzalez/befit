@extends('layouts.app')


@section('content')
    <h1>Informe de Ventas por Turno</h1>
    <div id="container">
    @foreach ($salesByShift as $sales)
    <div id="accordion">
    <div class="card">
        <div class="card-header" id="heading{{ $loop->iteration }}">
            <h2 class="mb-0">
                <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}">
                    Turno: {{ __($sales->shift) }}
                </button>
            </h2>
        </div>

        <div id="collapse{{ $loop->iteration }}" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Total de Ventas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales->where('shift', $sales->shift)->get() as $sale)
                            <tr>
                                <td>{{ $sale->sale_date }}</td>
                                <td>${{ $sale->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
        <div id="pieChartContainer" style="width: 100%; height: 400px; display: flex; justify-content: center; align-items: center;">
    <div id="pieChart" style="width: 50%; height: 100%;"></div>
</div>

    </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Turno');
        data.addColumn('number', 'Ventas');

        var salesData = [
            @foreach ($salesByShift as $sales)
                ['Turno: {{ $sales->shift }}', {{ $sales->total_sales }}],
            @endforeach
        ];

        data.addRows(salesData);

        var options = {
            title: 'Ventas por Turno',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart);
</script>

@endsection
