@extends('layouts.app')

@section('content')
    <h2>Expenses</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Crear Gasto</a>
    <table class="table">
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Usuario</th>
                <th>Turno</th>
                <th>Nombre Gasto</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->subsidiary->name }}</td>
                    <td>{{ $expense->user->name }}</td>
                    <td>{{ $expense->shift }}</td>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('expenses.delete', $expense->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $expenses->links() }}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection
