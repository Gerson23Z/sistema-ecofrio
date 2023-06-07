<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Venta de Aire Acondicionado</h4>
    </div>

    <style>
        .item-lista {
            /* Estilos personalizados */
            background-color: #f2f2f2;
            color: #333;
            padding: 5px 10px;
            cursor: pointer;
            list-style-type: none;
            /* Quitar las viñetas */
            margin: 0;
        }

        .item-lista:hover {
            /* Estilos al pasar el cursor por encima */
            background-color: #ddd;
        }
    </style>

    <div class="card-body">
        <form id="frmAires">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="txtCodigo">Codigo</label>
                        <input id="txtCodigo" class="form-control" type="text" name="txtCodigo" autocomplete="off"
                            onkeyup="getCodigosAires(event)">
                        <ul id="lista"></ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txtProducto">Producto</label>
                        <input id="txtProducto" class="form-control" type="text" name="txtProducto">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="txtCantidad">Cantidad</label>
                        <input id="txtCantidad" class="form-control" type="number" name="txtCantidad"
                            onkeyup="calcularPrecioAire(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="txtPrecio">Precio</label>
                        <input id="txtPrecio" class="form-control" type="text" name="txtPrecio" disabled>
                    </div>
                </div>
                <div class="col-md-2 float-right">
                    <div class="form-group">
                        <label for="txtStock">En Existencia</label>
                        <input id="txtStock" class="form-control" type="text" name="txtStock" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="txtSubTotal">Sub total</label>
                        <input id="txtSubTotal" class="form-control" type="text" name="txtSubTotal" disabled>
                    </div>
                </div>
            </div>
    </div>
</div>

<table class="table table-light table-bordered table-hover">
    <thead class="table-success">
        <tr>
            <th>Codigo</th>
            <th>Marca</th>
            <th>Capacidad</th>
            <th>Seer</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub total</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tblDetallesVntAire">
    </tbody>
</table>

<label for="">Datos Cliente</label>
<div class="form-row">
    <div class="form-group col-md-2">
        <label for="dui">DUI <i class="fas fa-id-card"></i></label>
        <input type="number" class="form-control" id="dui" name="dui" onkeyup="clienteClck(event)">
    </div>
    <div class="form-group col-md-4">
        <label for="nombreCliente">Nombre <i class="fas fa-user"></i></label>
        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"
            onkeyup="sig(event, 'telefonoCliente')">
    </div>
    <div class="form-group col-md-2">
        <label for="telefonoCliente">Telefono <i class="fas fa-phone"></i></label>
        <input type="number" class="form-control" id="telefonoCliente" name="telefonoCliente"
            onkeyup="sig(event, 'direccionCliente')">
    </div>
    <div class="form-group col-md-4">
        <label for="direccionCliente">Direccion <i class="fas fa-address-book"></i></label>
        <input type="text" class="form-control" id="direccionCliente" name="direccionCliente">
    </div>
</div>
</form>

<div class="col-md-3 ml-auto">
    <div class="form-group">
        <label for="txtTotal">Total</label>
        <input id="txtTotal" class="form-control" type="text" name="txtTotal" disabled>
    </div>
    <button class="btn btn-info" type="button" id="btnId" onclick="registrarVentaAire(event)">Registrar</button>
</div>

<script src="<?php echo base_url; ?>Assets/js/funcionesAires.js"></script>
<?php include "Views/Templates/footer.php"; ?>