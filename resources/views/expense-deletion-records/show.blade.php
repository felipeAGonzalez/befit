@extends('layouts.app')

@section('content')
    <h1>Detalle de Registro de Eliminación de Gasto</h1>

    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $deletionRecord->id }}</td>
        </tr>
        <tr>
            <th>Gasto ID</th>
            <td>{{ $deletionRecord->expense_id }}</td>
        </tr>
        <tr>
            <th>Razón</th>
            <td>{{ $deletionRecord->reason }}</td>
        </tr>
        <!-- Otros campos aquí -->
    </table>

    <a href="{{ route('deletion-records.index') }}" class="btn btn-primary">Volver al Listado</a>
@endsection
