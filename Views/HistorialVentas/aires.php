<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Historial de ventas de Aires</h1>
</div>
<button class="btn btn-light mb-2 text-light" type="button" disabled>Agregar</button>
<a href="<?php echo base_url . "HistorialVentas/airesven" ?>" class="btn btn-primary float-right">Productos</a>
<table class="table table-light" id="tblHistorialVentasAires">
    <thead class="table-success">
        <tr>
            <th>#</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Usuario</th>
            <th></th>
        </tr>
    </thead>
</table>
<script src="<?php echo base_url; ?>Assets/js/funcionesAires.js"></script>
<?php include "Views/Templates/footer.php"; ?>