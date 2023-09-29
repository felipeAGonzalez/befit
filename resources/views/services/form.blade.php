@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($subsidiary) ? 'Editar Servicio' : 'Registrar Nuevo Servicio' }}</div>

                    <div class="card-body">
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
                                        <select name="category" class="form-select" id="category">
                                        <option value="" default>--Seleccione una Categoría</option>
                                                @foreach($categories as $key => $value)
                                                    <option value="{{ isset($service) ? $service->name : $value }}">{{ $value }}</option>
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
                                        <input type="text" class="form-control" id="price" name="price" value="{{ isset($service) ? $service->sell_price : old('sell_price') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($service) ? 'Actualizar' : 'Guardar' }}</button>
                        <a href="{{ route('services.index') }}" class="btn btn-info">Volver</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            var daysInput = document.getElementById('days');

            category.addEventListener('change', function() {
                var selectedCategory = category.value;
                if (selectedCategory === 'Anual') {
                    daysInput.value = '365';
                } else if (selectedCategory === 'Semestral') {
                    daysInput.value = '181';
                }else if (selectedCategory === 'Mensual') {
                    daysInput.value = '30';
                }else if (selectedCategory === 'Semanal') {
                    daysInput.value = '7';
                }else if (selectedCategory === 'Visita') {
                    daysInput.value = '1';
                }else
                    daysInput.value = '';
            });
        });
    </script>
@endsection
