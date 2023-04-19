<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inventario</h1>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmInventario()" ;>Nuevo</button>
<table class="table table-light" id="tblInventario">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Tipo</th>
            <th>Especificaciones</th>
            <th>Fecha</th>
            <th>Unidades</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>

<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Añadir</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProductos">
                    <div class="form-group">
                        <label for="txtCodigo">Codigo</label>
                        <input type="hidden" id="id" name="id">
                        <input id="txtCodigo" class="form-control" type="text" name="txtCodigo" placeholder="Codigo">
                    </div>
                    <div class="form-group">
                        <label for="txtProducto">Producto</label>
                        <input id="txtProducto" class="form-control" type="text" name="txtProducto" placeholder="Producto">
                    </div>
                    <div class="form-group">
                        <label for="slcTipo">Tipo</label>
                        <select id="slcTipo" class="form-control" name="slcTipo">
                            <option>Aire</option>
                            <option>Respuesto</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtEspecificaciones">Especificaciones</label>
                        <input id="txtEspecificaciones" class="form-control" type="text" name="txtEspecificaciones" placeholder="Especificaciones">
                    </div>
                    <div class="form-group">
                        <label for="txtUnidades">Unidades</label>
                        <input id="txtUnidades" class="form-control" type="text" name="txtUnidades" placeholder="Unidades">
                    </div>

                    <button class="btn btn-primary" type="button" onclick="registrarProducto(event)" id="btnId">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>