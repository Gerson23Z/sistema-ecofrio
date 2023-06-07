<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Respuestos Eliminados</h1>
</div>
<button class="btn btn-light mb-2 text-light" type="button" disabled>Agregar</button>
<a href="InventarioRespuestos" class="btn btn-primary mb-2 float-right">Volver a Inventario</a>

<table class="table table-light" id="tblRespuestosEliminados">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Fecha</th>
            <th>Unidades</th>
            <th>Estado</th>
            <th>Precio</th>
            <th></th>
        </tr>
    </thead>
</table>

<?php include "Views/Templates/footer.php"; ?>