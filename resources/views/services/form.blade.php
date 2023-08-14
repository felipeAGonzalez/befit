@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($service) ? 'Editar Servicio' : 'Dar de Alta Servicio' }}</h2>
        <form action="{{ isset($service) ? route('services.update', $service->id) : route('services.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @if (isset($service))
                @method('PUT')
            @endif
            <div class="container">
        <div class="row">
                <div class = "col-md-6">
                    <div class="form-group">
                        <label for="key">Clave:</label>
                        <input type="text" class="form-control" id="key" name="key" value="{{ isset($service) ? $service->key : old('key') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($service) ? $service->name : old('name') }}">
                    </div>
                    <div class="form-group">

                        <label for="category">Seleccione una Categoría:</label>
                        <select name="category" id="category">
                                @foreach($categories as $key => $value)
                                    <option value="{{ isset($service) ? $service->category : $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="days">Días: </label>
                        <label for="campo" class="form-label text-muted">(La cantidad colocada automáticamente puede ser modificada)</label>
                        <input type="text" class="form-control" id="days" name="days" value="{{ isset($service) ? $service->days : old('days') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Precio Publico:</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ isset($service) ? $service->price : old('price') }}">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($service) ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('services.index') }}" class="btn btn-info">Volver</a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var category = document.getElementById('category');
            var daysImput = document.getElementById('days');

            category.addEventListener('change', function() {
                var selectedCategory = category.value;
                if (selectedCategory === 'Anual') {
                    daysImput.value = '365';
                } else if (selectedCategory === 'Semestral') {
                    daysImput.value = '181';
                }
                else if (selectedCategory === 'Mensual') {
                    daysImput.value = '30';
                }else if (selectedCategory === 'Semanal') {
                    daysImput.value = '7';
                }else if (selectedCategory === 'Visita') {
                    daysImput.value = '1';
                }else
                    daysImput.value = '';
            });
        });
    </script>
@endsection
