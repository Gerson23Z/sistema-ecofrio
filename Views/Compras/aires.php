<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Nueva Venta</h4>
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
        <form id="frmCompraAires">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="txtCodigo">Codigo</label>
                        <input id="txtCodigo" class="form-control" type="text" name="txtCodigo" autocomplete="off"
                            onkeyup="getCodigosComprasAires(event)">
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
                            onkeyup="calcularPrecioCompraAire(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="txtPrecio">Precio</label>
                        <input id="txtPrecio" class="form-control" type="text" name="txtPrecio" disabled>
                        <span class="simbolo">$</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="txtSubTotal">Sub total</label>
                        <input id="txtSubTotal" class="form-control" type="text" name="txtSubTotal" disabled>
                        <span class="simbolo">$</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .simbolo {
        position: absolute;
        top: 60%;
        left: 200px;
        transform: translateY(-50%);
    }
</style>

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
    <tbody id="tblDetallesCmpAire">
    </tbody>
</table>

<div class="col-md-3 ml-auto">
    <div class="form-group">
        <label for="txtTotal">Total</label>
        <input id="txtTotal" class="form-control" type="text" name="txtTotal" disabled>
    </div>
    <button class="btn btn-info" type="button" id="btnId" onclick="registrarCompraAire(event)">Registrar</button>
</div>

<script src="<?php echo base_url; ?>Assets/js/funcionesComprasAires.js"></script>
<?php include "Views/Templates/footer.php"; ?>