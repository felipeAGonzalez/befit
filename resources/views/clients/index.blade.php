@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Clientes</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Dar de Alta Cliente</a>
        <table class="table table-bordered">
            <!-- Contenido de la tabla -->
        </table>
    </div>
@endsection
