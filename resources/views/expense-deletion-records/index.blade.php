@extends('layouts.app')

@section('content')
    <h1>Listado de Registros de Eliminación de Gastos</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Gasto ID</th>
                <th>Razón</th>
                <!-- Otros encabezados aquí -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deletionRecords as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->expense_id }}</td>
                    <td>{{ $record->reason }}</td>
                    <!-- Otros campos aquí -->
                    <td>
                        <a href="{{ route('deletion-records.show', $record) }}" class="btn btn-info">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            {!!$deletionRecords->links()!!}
            </ul>
        </nav>
    </div>
@endsection
