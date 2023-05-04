<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Nueva Compra</h4>
    </div>
    <div class="card-body">
        <form id="frmCompras">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <input type="hidden" id="id" name="id">
                        <input id="txtCodigo" class="form-control" type="text" name="txtCodigo" placeholder="Codigo" onkeyup="buscarCodigo(event)">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="txtNombre" class="form-control" type="text" name="txtNombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="txtCantidad" class="form-control" type="text" name="txtCantidad"
                            placeholder="Cantidad" onkeyup="calcularPrecio(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="txtPrecio" class="form-control" type="text" name="txtPrecio" placeholder="Precio"
                            disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="txtSubTotal" class="form-control" type="text" name="txtSubTotal"
                            placeholder="Subtotal" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-light table-bordered table-hover">
    <thead class="table-success">
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub total</th>
            <th></th>
        </tr>
    </thead>
    <tbody  id="tblDetalles">

</tbody>
</table>

<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <input id="txtTotal" class="form-control" type="text" name="txtTotal" placeholder="total" disabled>
        </div>
        <button class="btn btn-info" type="button" id="btnId" onclick="(event)">Registrar</button>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>