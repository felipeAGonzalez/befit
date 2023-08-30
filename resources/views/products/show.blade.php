@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles del Producto</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Clave: {{ $subsidiaryProduct->product->key }}</h5>
                <p class="card-text">Nombre: {{ $subsidiaryProduct->product->name }}</p>
                <p class="card-text">Categoría: {{ $subsidiaryProduct->product->category->name }}</p>
                <p class="card-text">Precio Unitario: {{ $subsidiaryProduct->unit_price }}</p>
                <p class="card-text">Precio de Venta: {{ $subsidiaryProduct->sell_price }}</p>
                <p class="card-text">Cantidad: {{ $subsidiaryProduct->amount }}</p>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection
