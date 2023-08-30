@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Asistencia</h1>

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('attendance.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table">
             <thead class="table-dark">
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Fecha de Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            <img src="{{$client ? asset($client->photo):asset('default/no-photo-m.png')}}" alt="Foto" class="figure-img img-fluid rounded" style="max-width: 100px;">
                        </td>
                        <td>{{ $client ? $client->name : '' }}</td>
                        <td>{{ $client ? $client->clientDate->end_date->format('d-m-Y'): '' }}</td>
                    </tr>
            </tbody>
        </table>
    </div>
@endsection
