<?php
require_once '../util/funciones/definiciones.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo C_NOMBRE_SOFTWARE; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once 'ext_estilos.php'; ?>
    <link rel="stylesheet" href="../css/mapa.css">


</head>
<body class="sidebar-mini skin-blue-light sidebar-collapset">
<div class="wrapper">
    <?php include_once 'est_cabecera.php'; ?>
    <?php include_once 'est_menu.php'; ?>
    <div class="content-wrapper" id="reciclador_vista_nuevo"
         style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                CÓDIGO
                <small > Este código permite actualizar los pesos(valores) de los criterios</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-arrow-left"></i> Inicio</a></li>
            </ol>
        </section>
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-3"></div>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3 id="code_generate">150</h3>

                            <p>Nuevo Código</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="criterios.php" class="small-box-footer">Actualizar Criterios<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-3"></div>
            </div>
        </section>
    </div>

    <!-- /.content -->
</div>

<div class="control-sidebar-bg"></div>
</div>

<?php include_once 'ext_scripts.php'; ?>
<script src="../js/validacion.js"></script>
<!--<script src="../js/periodo.js"></script>-->
<script src="../js/code.js"></script>

</body>
</html>