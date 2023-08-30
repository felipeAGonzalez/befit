@extends('layouts.app')

@section('content')
    <h1>Sales Report</h1>

    <form action="{{ route('reports.sales') }}" method="GET">
        <div class="form-group">
            <label for="subsidiary_id">Subsidiary:</label>
            <select name="subsidiary_id" class="form-control">
                <!-- Populate with subsidiary options -->
            </select>
        </div>
        <div class="form-group">
            <label for="shift">Shift:</label>
            <select name="shift" class="form-control">
                <option value="morning">Morning</option>
                <option value="evening">Evening</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <table class="table">
         <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Total Sales</th>
                <th>Total Expenses</th>
                <th>Net Earnings</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->date }}</td>
                    <td>${{ $sale->total_sales }}</td>
                    <td>${{ $sale->total_expenses }}</td>
                    <td>${{ $sale->total_sales - $sale->total_expenses }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
