@extends('layouts.app')

@section('content')
    <h1>{{ isset($category) ? 'Editar Categoría' : 'Crear Categoría' }}</h1>
    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
        @csrf
        @if (isset($category))
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
@endsection
