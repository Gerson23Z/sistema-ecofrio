<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Historial de ventas</h1>
</div>

<table class="table table-light" id="tblHistorialVentas">
    <thead class="table-success">
        <tr>
            <th>#</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th></th>
        </tr>
    </thead>
</table>
<script src="<?php echo base_url; ?>Assets/js/funcionesVentas.js"></script>
<?php include "Views/Templates/footer.php"; ?>