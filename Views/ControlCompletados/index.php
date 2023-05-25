<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Control de Citas</h1>
</div>
<button class="btn btn-light mb-2 text-light" type="button" disabled>Agregar</button>
<a href="Control" class="btn btn-primary mb-2 float-right">Volver</a>
<table class="table table-light" id="tblCitasCom">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
</table>

<div id="nuevo_cita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Agendar Nueva Cita de Mantenimiento</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" id="frmCita">
            <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="nombre" id="nombre">
                        <label for="nombre" class="form-label">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="dui" id="dui">
                        <label for="dui" class="form-label">DUI</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="telefono" id="telefono">
                        <label for="telefono" class="form-label">Telefono</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="direccion" id="direccion">
                        <label for="direccion" class="form-label">Direccion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="tipo" class="form-control" name="tipo">
                            <option>Mantenimiento</option>
                            <option>Instalacion</option>
                        </select>
                        <label for="direccion" class="form-label">Tipo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="fecha" id="fecha">
                        <label for="fecha" class="form-label">Fecha</label>
                    </div>
                </div>
                <div class="moda-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal">Salir</button>
                    <button class="btn btn-info" type="button" id="btnId" onclick="registrarCita(event)">Registrar</button>
                    <button class="btn btn-info" type="button" id="btnIdMarcar" onclick="marcarCom(event)">Marcar como completada</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include "Views/Templates/footer.php"; ?>