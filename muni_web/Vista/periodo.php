<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 07/10/19
 * Time: 07:45 PM
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
    <link rel="stylesheet" href="../css/mapa.css">


</head>
<body class="sidebar-mini skin-blue-light sidebar-collapset">
<div class="wrapper">

    <?php include_once 'est_cabecera.php'; ?>
    <?php include_once 'est_menu.php'; ?>
    <?php require_once 'periodos_lista.php'; ?>
    <?php require_once 'modal_periodo.php'; ?>
    <!-- /.content -->
</div>

<div class="control-sidebar-bg"></div>
</div>

<?php include_once 'ext_scripts.php'; ?>
<script src="../js/validacion.js"></script>
<script src="../js/periodo.js"></script>

</body>
</html>
