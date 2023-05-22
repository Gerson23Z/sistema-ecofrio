<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url; ?>Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url; ?>Assets/css/main.min.css" rel="stylesheet">

    <title>Sistema</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url; ?>Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url; ?>Assets/css.css" rel="stylesheet">
    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url; ?>Assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Principal">
                <div class="sidebar-brand-text mx-3">Ecofrio</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="Principal">
                    <i class="fas fa-cash-register fa-2x"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading">
                Caja
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseVentas"
                    aria-expanded="true" aria-controls="collapseVentas">
                    <i class="fa fa-cash-register fa-2x"></i>
                    <span>Ventas</span>
                </a>
                <div id="collapseVentas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url."Ventas"?>"> <i
                                class="fas fa-cash-register fa-sm fa-fw mr-2"></i>Ventas</a>
                                <a class="collapse-item" href="<?php echo base_url."Ventas/aires"?>"> <i
                                class="fas fa-cash-register fa-sm fa-fw mr-2"></i>Ventas Aires</a>
                        <a class="collapse-item" href="<?php echo base_url."HistorialVentas"?>"> <i class="fas fa-list fa-sm fa-fw mr-2"></i>
                        Historial</a>
                    </div>
                </div>
            </li>

            <div class="sidebar-heading">
                Control
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseCitas"
                    aria-expanded="true" aria-controls="collapseCitas">
                    <i class="fa fa-calendar fa-2x"></i>
                    <span>Citas</span>
                </a>
                <div id="collapseCitas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url."Citas"?>"> <i
                                class="fas fa-calendar-days fa-sm fa-fw mr-2"></i>Calendario</a>
                        <a class="collapse-item" href="<?php echo base_url."Control"?>"> <i class="fas fa-list fa-sm fa-fw mr-2"></i>
                            Control</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url."Clientes"?>">
                    <i class="fas fa-users fa-2x"></i>
                    <span>Clientes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url."InventarioRespuestos"?>">
                    <i class="fas fa-box-open fa-2x"></i>
                    <span>Inventario</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-file-contract fa-2x"></i>
                    <span>Reportes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseEntradas"
                    aria-expanded="true" aria-controls="collapseEntradas">
                    <i class="fa fa-cart-shopping fa-2x"></i>
                    <span>Entradas</span>
                </a>
                <div id="collapseEntradas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url."Compras"?>"> <i
                                class="fas fa-cart-shopping fa-sm fa-fw mr-2"></i>Compras</a>
                        <a class="collapse-item" href="<?php echo base_url."HistorialCompras"?>"> <i class="fas fa-list fa-sm fa-fw mr-2"></i>
                        Historial</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrar
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ajustes</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url; ?>Usuarios/salir"> <i
                                class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Salir</a>
                        <a class="collapse-item" href="<?php echo base_url."Usuarios"?>"> <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                            Usarios</a>
                            <a class="collapse-item" href="<?php echo base_url."EmpresaConfiguracion"?>"> <i class="fas fa-building fa-sm fa-fw mr-2"></i>
                            Info. de la empresa</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- usuario informacion -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo base_url; ?>Assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container-fluid">