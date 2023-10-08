@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Productos</h2>
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Dar de Alta Producto</a>
            </div>
                @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE')
                        <div class="col-md-6">
                            <form action="{{ route('products.search') }}" method="GET" class="mb-3">
                                <div class="input-group mb-3">
                                <div class="form-inline">
                                    <select name="subsidiary_id" class="form-control mr-2" id="subsidiary_id">
                                        <option value="" default>Seleccione una sucursal</option>
                                            @foreach($subsidiary as $key => $value)
                                                <option value="{{$value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                            <a href="{{route('products.index')}}" class="btn btn-info">Limpiar Filtro</a>
                                            <a href="{{route('products.index')}}" class="btn btn-success">Poco Producto</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
        <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio Unitario</th>
                    <th>Precio de Venta</th>
                    <th>Cantidad</th>
                    @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE')
                        <th>Sucursal</th>
                    @endif
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subsidiaryProducts as $subsidiaryProduct)
                <tr>
                        <td>{{ $subsidiaryProduct->product->key }}</td>
                        <td>{{ $subsidiaryProduct->product->name }}</td>
                        <td>{{ $subsidiaryProduct->product->category->name }}</td>
                        <td>{{ $subsidiaryProduct->unit_price }}</td>
                        <td>{{ $subsidiaryProduct->sell_price }}</td>
                        <td>{{ $subsidiaryProduct->amount }}</td>
                        @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE')
                            <td>{{ $subsidiaryProduct->subsidiary->name }}</td>
                        @endif
                        <td>
                        <a href="{{ route('products.show', $subsidiaryProduct->product->id) }}" class="btn btn-info">Ver</a>
                        @if (auth()->user()->position == 'ROOT' || auth()->user()->position == 'DIRECTIVE')
                            <a href="{{ route('products.edit', $subsidiaryProduct->product->id) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('products.addShow', $subsidiaryProduct->product->id) }}" class="btn btn-success">Añadir</a>
                            <form action="{{ route('products.destroy', $subsidiaryProduct->product->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                            </form>
                        @endif
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
