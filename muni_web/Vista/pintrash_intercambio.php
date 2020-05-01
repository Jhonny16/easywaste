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
    <div class="content-wrapper" id="venta_vista_crear"
         style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(255,255,255)95%);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pintrash
                <small id="operation">Canje</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-arrow-left"></i> Inicio</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h5 class="box-title" style="color: #01a189">Canje de premios</h5>
                            <input type="text" id="user_id" style="display: none">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Proveedor</label>
                                        <select class="form-control select2" style="width: 100%;" id="combo_proveedores_list">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pintrash.</label>
                                        <input type="number" class="form-control" id="txt_pintrash"
                                               placeholder="Pintrash" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Premio</label>
                                        <select class="form-control select2" style="width: 100%;" id="combo_premios_list">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="number" class="form-control" id="txt_stock"
                                               placeholder="Stock" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Cantidad.</label>
                                        <input type="number" class="form-control" id="txt_cantidad"
                                               placeholder="Ingrese cantidad" >
                                    </div>
                                    <div>
                                        <div class="box-footer">
                                            <button type="button" onclick="add_det_premio()" class="btn btn-foursquare pull-right">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                Añadir</button>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-7">
                                    <div class="col-xs-12">
                                        <div class="box box-success">
                                            <div class="box-header">
                                                <h3 class="box-title">Detalle</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Premio</th>
                                                        <th>Cantidad</th>
                                                        <th>Total puntos</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbl_premio_canje">
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-6"></div>
                                    <div class="col-xs-6">
                                        <div class="table-responsive">
                                            <table class="table small">
                                                <tr>
                                                    <th>Total puntos:</th>
                                                    <td id="total_puntos"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Cancel</button>
                            <button type="button" class="btn btn-info pull-right" onclick="guardar_canje()">Guardar</button>
                        </div>
                        <!-- /.box-footer -->


                    </div>

                </div>
            </div>
        </section>

    </div>
    <!-- /.content -->
</div>

<div class="control-sidebar-bg"></div>
</div>

<!--<script src="../js/usuario_rol_permisos.js" type="text/javascript"></script>-->
<?php include_once 'ext_scripts.php'; ?>
<script src="../js/login.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/pintrash.js"></script>


</body>
</html>