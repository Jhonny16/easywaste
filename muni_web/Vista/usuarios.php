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
<body class="sidebar-mini skin-blue-light sidebar-collapset sidebar-collapse">
<div class="wrapper">
    <?php include_once 'est_cabecera.php'; ?>
    <?php include_once 'est_menu.php'; ?>
    <div class="content-wrapper"
         style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Usuarios
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-arrow-left"></i> Inicio</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12 col-lg-7">
                    <div class="box box-info">
                        <div class="box-header with-border"> <h5 class="box-title" style="color: #01a189">
                                Lista
                            </h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-lg-12"  id="listado_users"></div>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-lg-5">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h5 class="box-title" style="color: #01a189">Datos del usuario:
                            </h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Activo</label>
                                    <div class="col-sm-10">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="rbestado" class="flat-red"
                                                       id="rbactivo"
                                                       value="1" checked> SI
                                            </label>
                                            <label>
                                                &nbsp;&nbsp;<input type="radio" class="flat-red"
                                                                   name="rbestado"
                                                                   id="rbnoactivo"
                                                                   value="0"> NO
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre Completo</label>
                                    <input type="text" style="display: none" id="usuario_id">
                                    <input type="text" class="form-control" id="txtnombre_completo" readonly
                                           placeholder="Ingrese nombre completo...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Documento</label>
                                    <input type="number" class="form-control" id="txtdocumento" maxlength="11"
                                           placeholder="Ingrese número de documento ...">
                                </div>
                                <div class="form-group" id="divcheck_contrasenia" style="display:none">
                                    <label for="exampleInputPassword1">Cambiar contraseña</label>
                                    <label>
                                        <input type="checkbox" class="flat-red" id="check_contrasenia">
                                    </label>
                                </div>

                                <div class="form-group" id="div_contrasenia">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input type="password" class="form-control" id="txtcontrasenia"
                                           placeholder="Ingrese contraseña ..." onblur="validar_password()">
                                </div>
                                <div class="form-group" id="divnueva_contrasenia" style="display:none">
                                    <label for="exampleInputPassword1">Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="txtnueva_contrasenia"
                                           placeholder="Ingrese contraseña ..." readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3">Tipo de Usuario</label>
                                    <select name="" id="combo_tipousuario" class="form-control">
                                        <option value="1">Médico Administrador</option>
                                        <option value="2">Médico</option>
                                        <option value="3">Enfermera</option>
                                        <option value="4">Paciente</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-info" onclick="usuario_add()">Guardar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <?php require_once 'mdl_regla_analisis.php' ?>
    <?php require_once 'mdl_regla_sintomas.php' ?>

    </section>
    <!-- /.content -->
</div>

<div class="control-sidebar-bg"></div>
</div>

<!--<script src="../js/usuario_rol_permisos.js" type="text/javascript"></script>-->
<?php include_once 'ext_scripts.php'; ?>
<script src="../js/validacion.js"></script>
<script src="../js/usuario.js"></script>

</body>
</html>
