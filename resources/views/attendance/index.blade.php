@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Asistencia</h1>

        <div class="row">
            <div class="col-md-3">
                <form action="{{ route('attendance.search') }}" method="GET" class="mb-3">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por clave">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table">
             <thead class="table-dark">
                <tr>
                    <th>Foto</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Fecha de Vencimiento</th>
                    @if($client)
                        @if($client->clientDate->days_service != null)
                            <th>Días de Visita</th>
                        @endif
                    @endif
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            <img src="{{$client ? asset($client->photo):asset('default/no-photo-m.png')}}" alt="Foto" class="figure-img img-fluid rounded" style="max-width: 100px;">
                        </td>
                        <td>{{ $client ? $client->id : '' }}</td>
                        <td>{{ $client ? $client->name : '' }}</td>
                        <td>{{ $client ? $client->clientDate->end_date->format('d-m-Y'): '' }}</td>
                        @if($client)
                        @if($client->clientDate->days_service != null)
                            <td>{{ $client ? $client->clientDate->days_service: '' }}</td>
                        @endif
                    @endif
                    </tr>
            </tbody>
        </table>
        <form action="{{ $client ? route('attendance.register', $client->id) : '' }}" method="PATCH" class="mb-3">
            <div class="input-group">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                    <a href="{{ route('attendance.index') }}" class="btn btn-info">Limpiar</a>
                </div>
            </div>
        </form>
    </div>
    @if(Session::has('message'))
    <div class="alert2 alert2-danger">
        <ul>
            <li>{!! Session::get('message') !!}<br></li>
        </ul>
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
