@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($client) ? 'Editar Cliente' : 'Dar de Alta Cliente' }}</h2>
        <form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @if (isset($client))
                @method('PUT')
            @endif
            <div class="container">
        <div class="row">
                <div class = "col-md-6">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($client) ? $client->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Primer Apellido:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($client) ? $client->last_name : old('last_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name_two">Segundo Apellido:</label>
                        <input type="text" class="form-control" id="last_name_two" name="last_name_two" value="{{ isset($client) ? $client->last_name_two : old('last_name_two') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ isset($client) ? $client->email : old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ isset($client) ? $client->birth_date->format('Y-m-d') : old('birth_date') }}">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                        <label for="phone_number">Teléfono:</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" value="{{ isset($client) ? $client->phone_number : old('phone_number') }}">
                    </div>
                    <div class="form-group">
                        <label for="date_entry">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" id="date_entry" name="date_entry" value="{{ isset($clientDate) ? $clientDate->date_entry->format('Y-m-d') : date('Y-m-d') }}">
                    </div>
                    @if(isset($client))
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Actual:</label><br>
                        <img src="{{$client->photo ? asset($client->photo):asset('default/no-photo-m.png')}}" alt="Foto actual">
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="photo" class="form-label">Selecciona una imagen:</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($client) ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('clients.index') }}" class="btn btn-info">Volver</a>
        </form>
        @if ($errors->any())
                <div class="alert2 alert2-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}<br></li>
                        @endforeach
                        </ul>
                    </div>
            @endif
    </div>
@endsection
