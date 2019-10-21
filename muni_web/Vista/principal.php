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
        <?php include_once 'est_contenido.php'; ?>

        <div class="control-sidebar-bg"></div>
    </div>

<!--<script src="../js/usuario_rol_permisos.js" type="text/javascript"></script>-->
<?php include_once 'ext_scripts.php'; ?>
<script src="../js/validacion.js"></script>

</body>
</html>
