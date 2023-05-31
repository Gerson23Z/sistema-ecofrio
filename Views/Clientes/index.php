<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
</div>

<table class="table table-light" id="tblClientes">
    <thead class="table-success">
        <tr>
            <th>id</th>
            <th>DUI</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th></th>
        </tr>
    </thead>
</table>

<div id="editar_cliente" class="modal fde" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Editar Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmClientes">
                    <div class="form-group">
                        <label for="dui">DUI <i class="fas fa-id-card"></i></label>
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" id="dui" name="dui" onkeyup="clienteClck(event)">
                    </div>
                    <div class="form-group">
                        <label for="nombreCliente">Nombre <i class="fas fa-user"></i></label>
                        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"
                            onkeyup="sig(event, 'telefonoCliente')">
                    </div>
                    <div class="form-group">
                        <label for="telefonoCliente">Telefono <i class="fas fa-phone"></i></label>
                        <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente"
                            onkeyup="sig(event, 'direccionCliente')">
                    </div>
                    <div class="form-group">
                        <label for="direccionCliente">Direccion <i class="fas fa-address-book"></i></label>
                        <input type="text" class="form-control" id="direccionCliente" name="direccionCliente">
                    </div>
                    <button class="btn btn-primary" type="button" onclick="modificarCliente(event)"
                        id="btnId">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>