@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($subsidiary) ? 'Editar Sucursal' : 'Registrar Nueva Sucursal' }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($subsidiary) ? route('subsidiaries.update', $subsidiary) : route('subsidiaries.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($subsidiary))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($subsidiary) ? $subsidiary->name : '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', isset($subsidiary) ? $subsidiary->address : '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>

                            <div class="form-group">
                                <label for="zip_code">Código Postal</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code', isset($subsidiary) ? $subsidiary->zip_code : '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Número de Teléfono</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', isset($subsidiary) ? $subsidiary->phone_number : '') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($subsidiary) ? 'Actualizar' : 'Registrar' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
