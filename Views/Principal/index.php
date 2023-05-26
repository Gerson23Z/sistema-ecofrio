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
                Citas
                <i class="fas fa-calendar fa-2x ml-auto"></i>
            </div>
            <div class="card-footer bg-danger text-white d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Control" class="text-white">Ver detalles</a>
                <span>
                    <?php echo $data['mantenimientos']['total']; ?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="my-4"></div> <!-- Espacio en blanco -->

<div class="row">
    <a href="Ventas" class="col-xl-4 mb-4 offset-md-2">
        <div class="card border-left-success shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Ingresar Ventas
                            Productos</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cash-register fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <a href="Ventas/aires" class="col-xl-4 mb-4">
        <div class="card border-left-success shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Ingresar Venta Aires</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cash-register fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="row">
    <a href="InventarioRespuestos" class="col-xl-4 mb-4 offset-md-2">
        <div class="card border-left-success shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Inventario de Productos</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <a href="InventarioAires" class="col-xl-4 mb-4">
        <div class="card border-left-success shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Inventario de Aires</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="row">
    <a href="Citas" class="col-xl-4 mb-4 offset-md-2">
        <div class="card border-left-success shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Agendar Cita</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <a href="Clientes" class="col-xl-4 mb-4">
        <div class="card border-left-success shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Clientes</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php include "Views/Templates/footer.php"; ?>