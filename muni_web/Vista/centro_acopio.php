<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 01/12/19
 * Time: 07:33 PM
 */

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
<body class="sidebar-mini skin-blue-light sidebar-collapset">
<div class="wrapper">

    <?php include_once 'est_cabecera.php'; ?>
    <?php include_once 'est_menu.php'; ?>
    <div class="content-wrapper"          style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Centro Acopio
                <small id="operation">Lista</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-arrow-left"></i> Inicio</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">
                                <button type="button" onclick="modal_acopio()" class="btn btn-primary pull-right"
                                        data-toggle="modal" data-target="#modal_ca">
                                    <i class="fa fa-plus"></i>
                                    Nuevo</button>
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12">
                                    <div id="centro_acopio_list"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include_once 'modal_centro_acopio.php'; ?>

        </section>
    </div>

</div>

<div class="control-sidebar-bg"></div>
</div>

<?php include_once 'ext_scripts.php'; ?>
<script src="../js/login.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/centro_acopio_list.js"></script>

</body>
</html>