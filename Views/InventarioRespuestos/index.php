<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inventario Respuestos</h1>
    <div class="d-grid gap-2 col-6 mx-auto">
        <a href="InventarioAires" class="btn btn-secondary col-6">Ir a Aires</a>
    </div>
</div>

<button class="btn btn-success mb-2" type="button" onclick="frmInventarioRespuestos()" ;>Agregar</button>
<a href="RespuestosEliminados" class="btn btn-primary mb-2 float-right">Productos Eliminados</a>

<table class="table table-light" id="tblInventarioRespuestos">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Producto</th>
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

<div id="nuevo_respuesto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
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
                <form method="post" id="frmRespuestos">
                    <div class="form-group">
                        <label for="txtCodigo">Codigo</label>
                        <input type="hidden" id="id" name="id">
                        <input id="txtCodigo" class="form-control" type="text" name="txtCodigo" placeholder="Codigo">
                    </div>
                    <div class="form-group">
                        <label for="txtProducto">Producto</label>
                        <input id="txtProducto" class="form-control" type="text" name="txtProducto"
                            placeholder="Producto">
                    </div>
                    <div class="form-group">
                        <label for="txtEspecificaciones">Especificaciones</label>
                        <input id="txtEspecificaciones" class="form-control" type="text" name="txtEspecificaciones"
                            placeholder="Especificaciones">
                    </div>
                    <div class="form-group">
                        <label for="txtUnidades">Unidades</label>
                        <input id="txtUnidades" class="form-control" type="number" name="txtUnidades"
                            placeholder="Unidades">
                    </div>

                    <button class="btn btn-primary" type="button" onclick="registrarRespuesto(event)"
                        id="btnId">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>