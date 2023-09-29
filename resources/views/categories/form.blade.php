@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($subsidiary) ? 'Editar Sucursal' : 'Registrar Nueva Sucursal' }}</div>

                    <div class="card-body">
                    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                            @csrf
                            @if(isset($category))
                                @method('PUT')
                            @endif

                            <div class="col-md-6">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ isset($category) ? $category->name : '' }}">
                        </div>
                        <br>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Actualizar' : 'Guardar' }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


