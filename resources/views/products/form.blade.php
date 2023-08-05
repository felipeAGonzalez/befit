@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dar de Alta Producto</h2>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">

            @csrf
            @if(isset($product))
            @method('PUT')
        @endif
            <div class="form-group">
                <label for="key">Clave:</label>
                <input type="text" name="key" id="key" class="form-control" value="{{ old('key', isset($product) ? $product->key : '') }}" required>
            </div>
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}" required>
            </div>
            <div class="form-group">
                <label for="category">Categoría:</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', isset($product) ? $product->category : '') }}" required>
            </div>
            <div class="form-group">
                <label for="unit_prize">Precio Unitario:</label>
                <input type="number" name="unit_prize" id="unit_prize" class="form-control" value="{{ old('unit_prize', isset($product) ? $product->unit_prize : '') }}" step="0.01" required>
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
@endsection
