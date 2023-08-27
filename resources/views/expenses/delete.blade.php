@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <p>¿Esta seguro de eliminar el gasto?</p>
            </div>
            <div class="card-body">
        <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <label for="deletion_reason">Razón de la eliminación</label>
                <textarea name="reason" id="reason" class="form-control" required></textarea>
            </div>
            <input type="hidden" name="expense_id" value="{{ $expense->id }}">
            <a href="{{ route('expenses.index') }}" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
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
