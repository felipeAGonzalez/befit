@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Productos</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Dar de Alta Producto</a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
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
                @foreach($subsidiaryProducts as $subsidiaryProduct)
                <tr>
                        <td>{{ $subsidiaryProduct->product->id }}</td>
                        <td>{{ $subsidiaryProduct->product->key }}</td>
                        <td>{{ $subsidiaryProduct->product->name }}</td>
                        <td>{{ $subsidiaryProduct->product->category->name }}</td>
                        <td>{{ $subsidiaryProduct->unit_price }}</td>
                        <td>{{ $subsidiaryProduct->sell_price }}</td>
                        <td>{{ $subsidiaryProduct->amount }}</td>
                        <td>
                        <a href="{{ route('products.show', $subsidiaryProduct->product->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('products.edit', $subsidiaryProduct->product->id) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('products.addShow', $subsidiaryProduct->product->id) }}" class="btn btn-success">Añadir</a>
                            <form action="{{ route('products.destroy', $subsidiaryProduct->product->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            {!!$subsidiaryProducts->links()!!}
            </ul>
        </nav>
    </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
                <div class="alert2 alert2-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}<br></li>
                        @endforeach
                        </ul>
                    </div>
            @endif
@endsection
