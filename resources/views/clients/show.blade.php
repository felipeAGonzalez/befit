@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles del Cliente</h2>
        <div class="card">
            <!-- Contenido de la tarjeta -->
        </div>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection
