@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Productos</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Dar de Alta Producto</a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio Unitario</th>
                    <th>Precio de Venta</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->key }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->unit_price }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>{{ $product->amount }}</td>
                        <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection
