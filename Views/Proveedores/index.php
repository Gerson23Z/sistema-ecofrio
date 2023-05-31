<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Proveedores</h1>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmProveedor()" ;>Nuevo</button>
<table class="table table-light" id="tblProveedores">
    <thead class="table-success">
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th></th>
        </tr>
    </thead>
</table>

<div id="nuevo_proveedor" class="modal fde" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Ingresr Nuevo Proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProveedores">
                    <div class="form-group">
                        <label for="nombreProveedor">Nombre <i class="fas fa-user"></i></label>
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" id="nombreProveedor" name="nombreProveedor">
                    </div>
                    <div class="form-group">
                        <label for="telefonoProveedor">Telefono <i class="fas fa-phone"></i></label>
                        <input type="text" class="form-control" id="telefonoProveedor" name="telefonoProveedor">
                    </div>
                    <div class="form-group">
                        <label for="direccionProveedor">Direccion <i class="fas fa-address-book"></i></label>
                        <input type="text" class="form-control" id="direccionProveedor" name="direccionProveedor">
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarProveedor(event)"
                        id="btnId">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>