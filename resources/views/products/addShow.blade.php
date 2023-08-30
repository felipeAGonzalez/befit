@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Añadir inventario</h2>
        <div class="card">
            <div class="card-body col-md-6">
                <h5 class="card-title">Clave: {{ $subsidiaryProduct->product->key }}</h5>
                <p class="card-text">Nombre: {{ $subsidiaryProduct->product->name }}</p>
                <p class="card-text">Categoría: {{ $subsidiaryProduct->product->category->name }}</p>
                <p class="card-text">Precio Unitario: {{ $subsidiaryProduct->unit_price }}</p>
                <p class="card-text">Precio de Venta: {{ $subsidiaryProduct->sell_price }}</p>
                <form action="{{ route('products.add',$subsidiaryProduct->product_id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <div class="card-input col-md-6">
                        <p class="card-text"><strong>Cantidad:</strong></p>
                        <input type="number" name="amount" id="amount" class="form-control" value="{{ $subsidiaryProduct->amount }}" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
                </form>
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
@endsection
