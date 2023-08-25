@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Servicios</h2>
        <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Dar de Alta Servicio</a>
        <table class="table mt-4">
        <thead>
                <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Días</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->key}}</td>
                        <td>{{ $service->name}}</td>
                        <td>{{ $service->category}}</td>
                        <td>{{ $service->days}}</td>
                        <td>$ {{ number_format($service->sell_price,2)}}</td>
                        <td>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este Servicio?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>        </table>
    </div>
@endsection
