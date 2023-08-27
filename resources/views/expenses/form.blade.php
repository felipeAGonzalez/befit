@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">
        @if(isset($expense))
            Editar Gasto
        @else
            Crear Gasto
        @endif
    </div>
    <div class="card-body">
        @if(isset($expense))
            <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
            @method('PUT')
        @else
            <form action="{{ route('expenses.store') }}" method="POST">
        @endif
            @csrf
            <div class="form-group">
                <label>Nombre del gasto</label>
                <input type="text" name="name" class="form-control" value="{{ isset($expense) ? $expense->name : '' }}">
            </div>
            <div class="form-group">
                <label>Descripción del gasto</label>
                <textarea name="expenses_description" class="form-control">{{ isset($expense) ? $expense->expenses_description : '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Cantidad</label>
                <input type="number" name="amount" class="form-control" value="{{ isset($expense) ? $expense->amount : '' }}">
            </div>
            <div class="form-group">
                        <label for="date">Fecha del Gasto:</label>
                        <label for="campo" class="form-label text-muted">(La fecha colocada no pude modificarse)</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ isset($expense) ? $expense->date->format('Y-m-d') : date('Y-m-d') }}">
                    </div>
            <button type="submit" class="btn btn-primary">
                @if(isset($expense))
                    Actualizar
                @else
                    Crear
                @endif
            </button>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary mt-3">Volver</a>

        </form>
    </div>
    </div>
    </div>
</div>
@if ($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="alertDown" class="alert2 alert2-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}<br></li>
                        @endforeach
                        </ul>
                </div>
            </div>
        </div>
@endif
@endsection
