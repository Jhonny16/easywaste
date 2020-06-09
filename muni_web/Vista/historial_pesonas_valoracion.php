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
    <!-- Tell the browser to be responsive to screen width -->
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
                Historial
                <small id="operation">Recicladores</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-arrow-left"></i> Inicio</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Filtrar por
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <span style="color: #999580">
                                    El filtro por rango de fechas afecta a la fecha de operación
                                    de los cambios en la valoración del reciclador.</span>
                            </div>
                             <div class="form-group">
                                <label>Fecha inicial:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="history_fecha_incial"
                                    value="2020-01-01">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>Fecha final:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="history_fecha_final"
                                           value="2020-01-01">
                                </div>
                                <!-- /.input group -->
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="button" onclick="lista()" class="btn btn-primary pull-right" style="color: #fec418">
                                <i class="fa fa-search-plus"> Buscar</i>
                            </button>
                        </div>
                    </div>

                </div><div class="col-xs-12 col-md-10">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title" style="color: #245269">Hitorial de cambios - Valoración de reciclador
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12">
                                    <div id="historial_reciclador_list"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </div>

</div>

<div class="control-sidebar-bg"></div>
</div>

<?php include_once 'ext_scripts.php'; ?>
<script src="../js/login.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/historial_reciclador_valoracion.js"></script>

</body>
</html>