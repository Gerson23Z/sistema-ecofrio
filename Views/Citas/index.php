<?php include "Views/Templates/header.php"; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Administrar citas</h1>
</div>
<!--full calendar -->
<div class="container">
    <div id='calendar'></div>
</div>
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="titulo"></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="formulario">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="nombre" id="nombre">
                        <label for="nombre" class="form-label">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="apellido" id="apellido">
                        <label for="apellido" class="form-label">Apellido</label>
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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="check" id="check">
                        <label class="form-check-label" for="check" id="labelcheck">
                            Marcar como completado
                        </label>
                    </div>
                </div>
                <div class="moda-footer">
                    <button class="btn btn-warning" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger" type="button" id="btnEliminar">Eliminar</button>
                    <button class="btn btn-info" type="submit" id="btnAccion">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/app.js"></script>

<?php include "Views/Templates/footer.php"; ?>