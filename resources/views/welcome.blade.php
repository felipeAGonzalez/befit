@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <!-- Aquí colocamos el logo o imagen -->

                <h2 class="mt-4">¡Bienvenido, {{ Auth::user()->name }}!</h2>
                <p>¡Gracias por visitar nuestra página de inicio!</p>
            </div>
        </div>
    </div>
@endsection
