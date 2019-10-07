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
    <div class="content-wrapper" id="pro_vista_lista"
         style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Proveedores
                <small>Lista</small>
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
                            <button type="button" class="btn btn-info pull-right" onclick="nuevo()" ><i class="fa fa-user-plus"></i> Nuevo</button>
                        </div>
                        <!-- /.box-header -->
                        <form class="form-horizontal">
                            <div class="box-body" id="proveedor_lista">

                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </section>
    </div>
    <?php require_once 'proveedor_create.php'; ?>
    <!-- /.content -->
</div>

<div class="control-sidebar-bg"></div>
</div>

<!--<script src="../js/usuario_rol_permisos.js" type="text/javascript"></script>-->
<?php include_once 'ext_scripts.php'; ?>
<script src="../js/validacion.js"></script>
<script src="../js/proveedor_list.js"></script>

</body>
</html>
