@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($subsidiary) ? 'Editar Sucursal' : 'Registrar Nueva Sucursal' }}</div>

                    <div class="card-body">
                    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">

                        @csrf
                        @if(isset($product))
                        @method('PUT')
                    @endif
                    <div class = "col-md-6">
                        <div class="form-group">
                            <label for="key">Clave:</label>
                            <input type="text" name="key" id="key" class="form-control" value="{{ old('key', isset($product) ? $product->key : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}" required>
                        </div>
                        <div class="form-group">
                        <label for="category">Seleccione una Categoría:</label>
                        <select name="category" id="category">
                            <option value="" default>--Seleccione Categoria--</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ isset($product) ? $product->category->name : $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Precio Unitario:</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', isset($product) ? $product->unit_price : '') }}" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="sell_price">Precio de Venta:</label>
                            <input type="number" name="sell_price" id="sell_price" class="form-control" value="{{ old('sell_price', isset($product) ? $product->sell_price : '') }}" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Cantidad:</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', isset($product) ? $product->amount : '') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
