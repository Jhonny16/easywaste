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
    <?php require_once 'criterios_datos.php'; ?>
    <?php require_once 'modal_codigo.php'; ?>
    <!-- /.content -->
</div>

<div class="control-sidebar-bg"></div>
</div>

<?php include_once 'ext_scripts.php'; ?>
<script src="../js/validacion.js"></script>
<!--<script src="../js/periodo.js"></script>-->
<script src="../js/criterios_normalizados.js    "></script>

</body>
</html>
