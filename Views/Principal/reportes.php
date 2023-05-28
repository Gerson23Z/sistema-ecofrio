<?php include "Views/Templates/header.php"; ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Administracion</h1>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex">
                Usuarios
                <i class="fas fa-user fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-primary text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Usuarios" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['usuarios']['total']; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body d-flex">
                Ventas
                <i class="fab fa-product-hunt fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-success text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>HistorialVentas" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['ventas']['total']; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white">
            <div class="card-body d-flex">
                Venta de airesacondicionados
                <i class="fas fa-cash-register fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-danger text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>HistorialVentas/aires" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['ventasaires']['total']; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white">
            <div class="card-body d-flex">
                Citas
                <i class="fas fa-calendar fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-secondary text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Control" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['citas']['total']; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="my-4"></div> <!-- Espacio en blanco -->
</div>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body d-flex">
                Respuestos en inventario
                <i class="fas fa-warehouse fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-success text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>InventarioRespuestos" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['inventariorespuestos']['total']; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body d-flex">
                Ganancias del dia
                <i class="fas fa-file-invoice-dollar fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-info text-white d-flex align-items-center justify-content-between">
                <span>
                    <?php echo  '$ '.$data['gananciastotales']; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white">
            <div class="card-body d-flex">
                Compras
                <i class="fas fa-cart-shopping fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-dark text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>HistorialCompras" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['compras']['total'] ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white">
            <div class="card-body d-flex">
                Aires en almacen
                <i class="fas fa-warehouse fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-danger text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>InventarioAires" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['inventarioaires']['total']; ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>