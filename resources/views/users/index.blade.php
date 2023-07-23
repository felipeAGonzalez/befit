@extends('layouts.app')

@section('content')
    <h1>Listado de Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
