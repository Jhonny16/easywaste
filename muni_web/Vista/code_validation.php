<?php
header('Access-Control-Allow-Origin: *');
require_once '../util/funciones/definiciones.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo C_NOMBRE_SOFTWARE; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once 'ext_estilos.php'; ?>


</head>
<!--<body class="sidebar-mini skin-blue-light sidebar-collapset">-->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header" >
        <nav class="navbar navbar-static-top" style="text-align: center;background-image: linear-gradient(500deg, rgb(0, 166, 90) 200px, rgb(0, 166, 90)60%);">
            <div class="container">
                <div class="navbar-header" >
                    <a href="" class="navbar-brand">EasyWaste</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper" style="background-color: white">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">


            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title">Ingrese su código de verificación</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="code_validate" placeholder="Ingrese códfigo de verificación">
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right" onclick="validate_code()"><i class="fa fa-check-circle-o text-white"></i> Validar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

    </footer>
</div>

<div class="control-sidebar-bg"></div>
</div>
<?php include_once 'ext_scripts_info.php'; ?>
<script src="../js/login.js"></script>
<script src="../js/code_validation.js"></script>


</body>
</html>