<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmUsuario()" ;>Nuevo</button>
<table class="table table-light" id="tblUsuarios">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Rol</th>
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

<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuarios">
                    <div class="form-group">
                        <label for="txtNombre">Nombre</label>
                        <input type="hidden" id="id" name="id">
                        <input id="txtNombre" class="form-control" type="text" name="txtNombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="txtApellido">Apellido</label>
                        <input id="txtApellido" class="form-control" type="text" name="txtApellido" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <label for="txtUsuario">Usuario</label>
                        <input id="txtUsuario" class="form-control" type="text" name="txtUsuario" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <label for="slctRol">Rol</label>
                        <select id="slctRol" class="form-control" name="slctRol">
                            <option>Admin</option>
                            <option>Secretaria</option>
                            <option>Caja</option>
                        </select>
                    </div>
                    <div class="row" id="idPass">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtPassword">Contraseña</label>
                                <input id="txtPassword" class="form-control" type="password" name="txtPassword">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtConfirmar">Confirmar Contraseña</label>
                                <input id="txtConfirmar" class="form-control" type="password" name="txtConfirmar">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarUser(event)" id="btnId">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include "Views/Templates/footer.php"; ?>