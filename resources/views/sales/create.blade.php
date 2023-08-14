@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Vender Productos y Servicios</h1>

    <div class="row mt-4">
        <div class="col-md-6">
            <!-- Buscador por Código de Barras -->
                <input type="text" id="seeker" name="seeker" class="form-control" placeholder="Buscar por Código de Barras">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <!-- Tabla de Lista de Compra -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto/Servicio</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="ListTable">
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                        <th id="total">0.00</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <!-- Formulario de Cobro y Registro en BD -->
            <form id="formularioVenta" action="{{ route('sales.store') }}" method="POST">
                @csrf
                <input type="hidden" name="elementsSold" id="productsJSON">
                <!-- Agregar más campos relacionados con la venta si es necesario -->
                <button type="submit" class="btn btn-primary">Realizar Cobro</button>
            </form>
        </div>
    </div>
</div>

<div id="mensajeNoEncontrado" class="alert alert-warning" style="display: none;">
    Producto no encontrado
</div>

<script>
    $(document).ready(function() {
        function mostrarProductosEnTabla(elements) {
            const ListTable = document.getElementById('ListTable');
            elements.forEach(element => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td style="display: none;"><span class="id">${element.id}</span></td>
                <td>${element.name}</td>
                <td><span class="qty">1</span></td>
                <td>$${element.sell_price.toFixed(2)}</td>
                <td>$<span class="subtotal">${element.sell_price.toFixed(2)}</span></td>
                `;

                ListTable.appendChild(row);
            });

            // Calcular y actualizar el total al cargar la página
            let total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total').text(total.toFixed(2));
        }

        $('#seeker').on('keydown', function(event) {
            const key = $(this).val();

            if (event.key === "Enter") {
                // Realizar una solicitud AJAX para buscar productos
                $.ajax({
                    url: '{{ route('element.search') }}',
                    method: 'GET',
                    data: { key: key },
                    success: function(response) {
                        if (response.length == 0) {
                            mostrarMensajeNoEncontrado();
                        }
                            mostrarProductosEnTabla(response);
                            $('#seeker').val('');
                    },
                    error: function() {
                        console.log('Error al buscar productos');
                    }
                });
            }
        });
        function mostrarMensajeNoEncontrado() {
            $('#mensajeNoEncontrado').text('Producto no encontrado').fadeIn().delay(2000).fadeOut();
        }
        $('#formularioVenta').submit(function(event) {
    event.preventDefault();

    const sellProduct = [];

    $('#ListTable tr').each(function() {
        const id = parseInt($(this).find('.id').text());
        const qty = parseFloat($(this).find('.qty').text()); // Usar text() para obtener el contenido del span
        const subtotal = parseFloat($(this).find('.subtotal').text());
        sellProduct.push({ id, qty, subtotal });
    });

    const productsJSON = JSON.stringify(sellProduct);

    // Establecer el valor del campo oculto con el JSON
    $('#productsJSON').val(productsJSON);

    // Enviar el formulario manualmente
    this.submit();
});


    });
</script>

@endsection
