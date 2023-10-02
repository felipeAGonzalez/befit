@extends('layouts.app')

@section('content')
    <h2>Gastos</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Crear Gasto</a>
    <table class="table">
         <thead class="table-dark">
            <tr>
                <th>Sucursal</th>
                <th>Usuario</th>
                <th>Turno</th>
                <th>Nombre Gasto</th>
                <th>Monto</th>
                @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE' || auth()->user()->position == 'MANAGER')
                <th>Acciones</th>
                @endif
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
                    @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE' || auth()->user()->position == 'MANAGER')
                    <td>
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('expenses.delete', $expense->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            {!!$expenses->links()!!}
            </ul>
        </nav>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection
