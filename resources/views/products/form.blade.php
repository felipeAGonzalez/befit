@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($subsidiaryProduct) ? 'Editar Producto' : 'Registrar Nuevo Producto' }}</div>

                    <div class="card-body">
                    <form action="{{ isset($subsidiaryProduct) ? route('products.update', $subsidiaryProduct->id) : route('products.store') }}" method="POST">
                        @csrf
                        @if(isset($subsidiaryProduct))
                        @method('PUT')
                    @endif
                    <div class = "col-md-6">
                    <div class="form-group">
                        <label for="subsidiary_id">Seleccione una Sucursal:</label>
                        <select name="subsidiary_id" class="form-select" id="subsidiary_id">
                            <option value="" default>Seleccione una opción</option>
                                @foreach($subsidiary as $key => $value)
                                    <option value="{{ $value->id }}" {{ isset($subsidiaryProduct) && $subsidiaryProduct->subsidiary->id == $value->id  ? 'selected' : $value->id }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                    </div>
                        <div class="form-group">
                            <label for="key">Clave:</label>
                            <input type="text" name="key" id="key" class="form-control" value="{{ old('key', isset($subsidiaryProduct) ? $subsidiaryProduct->product->key : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($subsidiaryProduct) ? $subsidiaryProduct->product->name : '') }}" required>
                        </div>
                        <div class="form-group">
                        <label for="category">Seleccione una Categoría:</label>
                        <select name="category" class="form-select" id="category">
                            <option value="">--Seleccione Categoría--</option>
                                @foreach($categories as $key => $value)
                                <option value="{{ $value->id }}" {{ isset($subsidiaryProduct) && $subsidiaryProduct->product->category->id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Precio Unitario:</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', isset($subsidiaryProduct) ? $subsidiaryProduct->unit_price : '') }}" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="sell_price">Precio de Venta:</label>
                            <input type="number" name="sell_price" id="sell_price" class="form-control" value="{{ old('sell_price', isset($subsidiaryProduct) ? $subsidiaryProduct->sell_price : '') }}" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Cantidad:</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', isset($subsidiaryProduct) ? $subsidiaryProduct->amount : '') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
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
    </div>
    </div>
    </div>
@endsection
