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



</head>
<body class="sidebar-mini skin-blue-light sidebar-collapset">
<div class="wrapper">

    <?php include_once 'est_cabecera.php'; ?>
    <?php include_once 'est_menu.php'; ?>
    <div class="content-wrapper" id="venta_vista_crear"
         style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Reporte de proveedores atendidos por reciclador
                <small id="operation">Lista</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-arrow-left"></i> Inicio</a></li>
            </ol>
        </section>
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Filtros</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Rango de fechas de Servicio:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="rep_prov_fechas">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <label>Recicladores</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                        id="combo_report_recicladores">
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" onclick="filtrar()" class="btn btn-info pull-right">
                                <i class="fa fa-filter text-white" aria-hidden="true"></i>
                                Filtrar
                            </button>
                            <!--                            <button type="button" onclick="genera_pdf()" class="btn btn-danger pull-right"><i-->
                            <!--                                        class="fa fa-file-pdf-o"></i> Exportar PDF-->
                            <!--                            </button>-->
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Resultado</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12">
                                    <div id="reporte_proveedores_reciclador"></div>
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
<script src="../js/reporte_proveedores_reciclador.js"></script>

</body>
</html>