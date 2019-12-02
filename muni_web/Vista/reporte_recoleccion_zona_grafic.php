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
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload=
                {'modules':[{'name':'visualization','version':'1.1','packages':
        ['corechart']}]}"></script>
    <script type="text/javascript">
        function drawVisualization2() {}

    </script>


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
                Reporte Recoleccion por zona
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
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="inputPassword3">Año inicio</label>
                                            <select name="" id="anio_inicial" class="form-control">
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">

                                    <div class="form-group">
                                            <label for="inputPassword3">Año final</label>
                                            <select name="" id="anio_final" class="form-control">
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <label>Zonas</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                        id="combo_report_zonas">
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
                                    <div id="reporte_recoleccion_grafico"></div>
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
<script src="../js/validacion.js"></script>
<script src="../js/reporte_recoleccion.js"></script>

</body>
</html>