@extends('layouts.app')

@section('content')
    <h1>Sucursales</h1>
    <a href="{{ route('subsidiaries.create') }}" class="btn btn-primary">Agregar Sucursal</a>
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Código Postal</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subsidiaries as $subsidiary)
                <tr>
                    <td>{{ $subsidiary->id }}</td>
                    <td>{{ $subsidiary->name }}</td>
                    <td>{{ $subsidiary->address }}</td>
                    <td>{{ $subsidiary->zip_code }}</td>
                    <td>{{ $subsidiary->phone_number }}</td>
                    <td>
                        <a href="{{ route('subsidiaries.edit', $subsidiary->id) }}" class="btn btn-primary">Editar</a>
                        <!-- Agregar botón de eliminación -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
