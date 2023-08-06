@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Clientes</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Dar de Alta Cliente</a>
        <table class="table mt-4">
        <thead>
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">Fecha de ingreso</th>
                    <th scope="col">Fecha de Vencimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td><img src="{{$client->photo ? asset('photo/$client->photo'):asset('default/no-photo-m.png')}}" alt="Imagen de Ejemplo">{{ $client->photo}}</td>
                        <td>{{ $client->name}}</td>
                        <td>{{ $client->last_name}}</td>
                        <td>{{ $client->last_name_two}}</td>
                        <td>{{ $client->email}}</td>
                        <td>{{ $client->birth_date->format('d-m-Y')}}</td>
                        <td>{{ $client->clientDate->date_entry->format('d-m-Y')}}</td>
                        <td>{{ $client->clientDate->end_date?$client->clientDate->end_date->format('d-m-Y'):'Sin datos'}}</td>
                        <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este Cliente?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>        </table>
    </div>
@endsection