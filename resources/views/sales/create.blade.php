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
                        <th>Código</th>
                        <th>Producto/Servicio</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <div class="row mt-4" id="assignButton">
                    <div class="col-md-6">
                        <button id="showClient" class="btn btn-info">Asignar a Cliente</button>
                    </div>
                </div>

                <div class="row mt-4" id="assignClient" style="display: none;">
                    <div class="col-md-6">
                        <label><strong>Asignar la venta a un cliente</strong></label><br>
                        <input type="text" class="form-control client-key"  id="inputClient" placeholder="Clave del cliente">
                    </div>
                </div>
                <br>
                <tbody id="ListTable">
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th colspan="3" class="text-right">Total</th>
                        <th id="total">0.00</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <form id="formularioVenta" action="{{ route('sales.store') }}" method="POST">
                @csrf
                <input type="hidden" name="elementsSold" id="productsJSON">
                <button type="submit" id="sendData" class="btn btn-primary">Realizar Cobro</button>
            </form>
        </div>
    </div>
    @if ($errors->any())
                <div id="alertDown" class="alert2 alert2-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}<br></li>
                        @endforeach
                        </ul>
                    </div>
            @endif
</div>

<div id="mensajeNoEncontrado" class="alert alert-warning" style="display: none;">
    Producto no encontrado
</div>

<script>

    document.getElementById('showClient').addEventListener('click', function() {
    var divB = document.getElementById('assignButton');
    var div = document.getElementById('assignClient');
    div.style.display = 'block';
    divB.style.display = 'none';
});
    $(document).ready(function() {
        function mostrarProductosEnTabla(elements) {
            const ListTable = document.getElementById('ListTable');
            elements.forEach(element => {
                element.product !== undefined ? key=element.product.key : key=element.key
            const productoExistente = $(`.key[data-key="${key}"]`);
            if (productoExistente.length > 0) {
                const qty = parseFloat(productoExistente.closest('tr').find('.qty').text());
                const nuevaCantidad = qty + 1;
                productoExistente.closest('tr').find('.qty').text(nuevaCantidad);
                const nuevoSubtotal = nuevaCantidad * element.sell_price;
                productoExistente.closest('tr').find('.subtotal').text(nuevoSubtotal.toFixed(2));
            } else {
                element.product !== undefined ? key=element.product.key : key=element.key
                element.product !== undefined ? category=element.product.category_id : category=element.category
                element.product !== undefined ? id=element.product.id : id=element.id
                element.product !== undefined ? name=element.product.name : name=element.name
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td style="display: none;"><span class="id" data-id="${id}">${id}</span></td>
                    <td><span class="key" data-key="${key}">${key}</span></td>
                    <td><span class="name">${name}</span></td>
                    <td style="display: none;"><span class="category">${category}</span></td>
                    <td><span class="qty">1</span></td>
                    <td>$${element.sell_price.toFixed(2)}</td>
                    <td>$<span class="subtotal">${element.sell_price.toFixed(2)}</span></td>
                    <td><i class="fas fa-times delete-element red-icon"></i></td>
                `;
                ListTable.appendChild(row);
            }
        });
            let total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total').text(total.toFixed(2));
        }
        $('#ListTable').on('click', '.delete-element', function() {
            const fila = $(this).closest('tr');
            const subtotal = parseFloat(fila.find('.subtotal').text());
            fila.remove();

            let total = parseFloat($('#total').text());
            total -= subtotal;
            $('#total').text(total.toFixed(2));
        });
        $('#seeker').on('keydown', function(event) {
            const key = $(this).val();

            if (event.key === "Enter") {
                $.ajax({
                    url: '{{ route('element.search') }}',
                    method: 'GET',
                    data: { key: key },
                    success: function(response) {
                        if (Object.keys(response).length == 0) {
                            mostrarMensajeNoEncontrado();
                            return;
                        }else{
                            mostrarProductosEnTabla(response);
                            $('#seeker').val('');
                        }
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
                const name = String($(this).find('.name').text());
                const category = String($(this).find('.category').text());
                const qty = parseFloat($(this).find('.qty').text());
                const subtotal = parseFloat($(this).find('.subtotal').text());
                let clientKey = null;
                const categories = [
                    'Anual',
                    'Semestral',
                    'Mensual',
                    'Semanal',
                    'Visita',
                    'Paquete Por Visitas'
                ];

                if (categories.includes(category)) {
                    clientKey = parseInt($('#inputClient').val());
                    console.log(clientKey);
                }
                sellProduct.push({ id, clientKey, name, category, qty, subtotal });
            });
            const productsJSON = JSON.stringify(sellProduct);

            $('#productsJSON').val(productsJSON);
            this.submit();
        });
        function quitarDiv() {
            const div = document.getElementById("alertDown");
            div.style.display = "none";
        }
        setTimeout(quitarDiv, 3000);

    });
</script>

@endsection
