<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Usuarios Desactivados</h1>
</div>
<a href="Usuarios" class="btn btn-primary float-right">Volver a Usuarios</a>
<table class="table table-light" id="tblUsuariosEliminados">
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
</table>

<?php include "Views/Templates/footer.php"; ?>