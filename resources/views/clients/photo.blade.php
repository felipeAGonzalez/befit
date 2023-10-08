@extends('layouts.app')

@section('content')
<form action="{{ route('clients.photo', $client->id)}}" enctype="multipart/form-data" method="POST">
    <div class="container">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Agregar Foto al Cliente</h2>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <td><img src="{{$client->photo ? asset($client->photo):asset('default/no-photo-m.png')}}" alt="Imagen de Ejemplo" class="img-fluid"></td>
                    </div>
                    <div class="col-md-8">
                        <h4>{{ $client->name }} {{ $client->last_name }} {{ $client->last_name_two }}</h4>
                        <p><strong>Email:</strong> {{ $client->email }}</p>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $client->birth_date->format('d/m/Y') }}</p>
                        <p><strong>Edad:</strong> {{ $client->birth_date->age }}</p>
                        <p><strong>Teléfono:</strong> {{ $client->phone_number }}</p>
                        @csrf
                        @method('PATCH')
                        <label for="photo" class="form-label">Selecciona una imagen:</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
            <div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('clients.index') }}" class="btn btn-info">Volver</a>
            </div>
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
