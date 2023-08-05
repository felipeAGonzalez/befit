@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles del Producto</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Clave: {{ $product->key }}</h5>
                <p class="card-text">Nombre: {{ $product->name }}</p>
                <p class="card-text">Categoría: {{ $product->category }}</p>
                <p class="card-text">Precio Unitario: {{ $product->unit_prize }}</p>
                <p class="card-text">Precio de Venta: {{ $product->sell_price }}</p>
                <p class="card-text">Cantidad: {{ $product->amount }}</p>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection
