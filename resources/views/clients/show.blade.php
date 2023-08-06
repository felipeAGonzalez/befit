@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Credencial de Cliente</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <td><img src="{{$client->photo ? asset($client->photo):asset('default/no-photo-m.png')}}" alt="Imagen de Ejemplo" class="img-fluid"></td>
                    </div>
                    <div class="col-md-8">
                        <h4>{{ $client->name }} {{ $client->last_name }} {{ $client->last_name_two }}</h4>
                        <p><strong>Email:</strong> {{ $client->email }}</p>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $client->birth_date->format('d/m/Y') }}</p>
                        <p><strong>Edad:</strong> {{ $client->birth_date->age }}</p>
                        <p><strong>Fecha de Ingreso:</strong> {{ $clientDate->date_entry->format('d/m/Y') }}</p>
                        <p><strong>Fecha de Antigüedad:</strong> {{ $clientDate->date_entry->age }}</p>
                    </div>
                </div>
            </div>
        </div>


    <div class="print-area">
    <div class="card">
            <div class="card-header">
                <h2>Credencial de Cliente</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <td><img src="{{$client->photo ? asset($client->photo):asset('default/no-photo-m.png')}}" alt="Imagen de Ejemplo" class="img-fluid"></td>
                    </div>
                    <div class="col-md-8">
                        <h4>{{ $client->name }} {{ $client->last_name }} {{ $client->last_name_two }}</h4>
                        <p><strong>Email:</strong> {{ $client->email }}</p>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $client->birth_date->format('d/m/Y') }}</p>
                        <p><strong>Edad:</strong> {{ $client->birth_date->age }}</p>
                        <p><strong>Fecha de Ingreso:</strong> {{ $clientDate->date_entry->format('d/m/Y') }}</p>
                        <p><strong>Fecha de Antigüedad:</strong> {{ $clientDate->date_entry->age }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <a href=# onclick="printContent()"class="btn btn-secondary mt-3">Imprimir</a>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Volver</a>
    <style>
    .print-area {
        display: none; /* Oculta el área de impresión por defecto */
    }

    @media print {
        .print-area {
            display: block; /* Muestra el área de impresión al imprimir */
        }

        /* Puedes ajustar los estilos de impresión aquí */
        h1 {
            font-size: 20px;
        }
    }
</style>
    <script>
    function printContent() {
        window.print(); // Abre el cuadro de diálogo de impresión
    }
</script>
@endsection
