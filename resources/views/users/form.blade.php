@extends('layouts.app')

@section('content')
    <h1>{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}</h1>
    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
        <div class = "col-md-6">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
            </div>
            <div class="form-group">
            <label for="subsidiary_id">Seleccione una Sucursal:</label>
            <select name="subsidiary_id" class="form-select" id="subsidiary_id">
                <option value="" default>Seleccione una opción</option>
                    @foreach($subsidiary as $key => $value)
                        <option value="{{ $value->id }}" {{ isset($user) && $user->subsidiary->id == $value->id  ? 'selected' : $value->id }}>{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="shift">Seleccione un turno:</label>
                <select name="shift" class="form-select" id="shift">
                    <option value="none" {{ $user->shift === 'none' ? 'selected' : '' }}>No aplica</option>
                    <option value='Morning' {{ $user->shift === 'Morning' ? 'selected' : '' }}>Matutino</option>
                    <option value='Afternoon' {{ $user->shift === 'Afternoon' ? 'selected' : '' }}>Vespertino</option>
                </select>
            </div>
            <div class="form-group">
                <label for="position">Seleccione un cargo:</label>
                <select name="position" class="form-select" id="position">
                    <option value="" disabled>Seleccione una opción</option>
                    @foreach($position as $key => $value)
                        <option value="{{ $key }}" {{ isset($user) && $user->position == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
        @if ($errors->any())
                <div class="alert2 alert2-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}<br></li>
                        @endforeach
                        </ul>
                    </div>
            @endif
    </form>
@endsection
