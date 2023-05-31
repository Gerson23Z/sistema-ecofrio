<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Historial de Compras de lotes de Aires</h1>
</div>

<table class="table table-light" id="tblHistorialComprasAires">
    <thead class="table-success">
        <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Marca</th>
            <th>Cpacidad</th>
            <th>Seer</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Fecha</th>
            <th>Proveedor</th>
        </tr>
    </thead>
</table>
<script src="<?php echo base_url; ?>Assets/js/funcionesComprasAires.js"></script>
<?php include "Views/Templates/footer.php"; ?>