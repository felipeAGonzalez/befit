@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($client) ? 'Editar Cliente' : 'Dar de Alta Cliente' }}</h2>
        <form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" method="POST">
            @csrf
            @if (isset($client))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ isset($client) ? $client->name : old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ isset($client) ? $client->email : old('email') }}">
            </div>

            <!-- Agrega aquí los demás campos del formulario -->

            <button type="submit" class="btn btn-primary">{{ isset($client) ? 'Actualizar' : 'Guardar' }}</button>
        </form>
    </div>
@endsection
