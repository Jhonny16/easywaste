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
                    <a href="../../index2.html" class="navbar-brand">EasyWaste</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="../imagenes/useri.png" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"></span>
                            </a>
                        </li>
                    </ul>
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
                <div class="row" id="data_informacion">
<!--                    <div class="col-lg-6 col-xs-12"><img src="../imagenes/store.png" alt=""></div>-->
                    <div class="col-lg-6 col-xs-12">B</div>
                    <div class="col-lg-6 col-xs-12">C</div>
                    <div class="col-lg-6 col-xs-12">D</div>
                    <div class="col-lg-6 col-xs-12">E</div>
<!--                    <div class="col-xs-6 col-md-9 col-lg-9" >-->
<!--                        <div id="list_info"></div>-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 col-md-3 col-lg-3" >-->
<!--                        <div></div>-->
<!--                    </div>-->
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title">¿Le fue útil esta información?</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>
                                        SI<input type="radio" name="radio_info" class="minimal" id="info_si">
                                    </label>
                                    <label>
                                        NO<input type="radio" name="radio_info" class="minimal"  id="info_no" checked>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Observación</label>
                                    <textarea class="form-control" rows="3" placeholder="Ingrese algún comentario adicional..." id="info_observacion"></textarea>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right" onclick="sensibilizacion_add()"><i class="fa fa-save text-white"></i> Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once 'modal_descripcion.php'; ?>
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
<script src="../js/login.js"></script>
<script src="../js/sensibilizacion_info.js"></script>


</body>
</html>