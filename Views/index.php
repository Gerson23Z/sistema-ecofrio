<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url; ?>Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url; ?>Assets/css.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url; ?>Assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div id="tit">
                                            <h1 class="h4 text-gray-900 mb-4">Binvenido a</h1>
                                            <h1 class="h4 text-success mb-4"> Eco</h1>
                                            <h1 class="h4 text-primary mb-4">frio</h1>
                                        </div>
                                    </div>
                                    <form class="user" id="frmLogin">
                                        <div class="form-group">
                                            <label class="small mb-1" for="txtUsuario"> <i
                                                    class="fas fa-user"></i>Usuario</label>
                                            <input type="text" class="form-control form-control-user" id="txtUsuario"
                                                name="txtUsuario" placeholder="Ingrese Usuario" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="txtPassword"> <i
                                                    class="fas fa-key"></i>Contraseña</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="txtPassword" name="txtPassword" placeholder="Ingrese Contraseña" />
                                        </div>
                                        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">

                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" onclick="frmLogin(event);"
                                            type="submit">Login</button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url; ?>Assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"
        crossorigin=" anonymous"></script>
    <script src="<?php echo base_url; ?>Assets/vendor/jquery-easing/jquery.easing.min.js"
        crossorigin=" anonymous"></script>

    <script src="<?php echo base_url; ?>Assets/js/sb-admin-2.min.js" crossorigin=" anonymous"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/funciones.js" crossorigin=" anonymous"></script>
</body>
</html>