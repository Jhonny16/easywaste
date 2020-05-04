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
                Perfil de Usuario
                <small id="operation"></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-arrow-left"></i> Inicio</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Mi Perfil</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12">
                                    <form class="form-horizontal">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-xs-12">
<!--                                                    <div class="form-group">-->
<!--                                                        <label for="inputEmail3" class="col-sm-3 control-label">Tipo.</label>-->
<!---->
<!--                                                        <div class="col-sm-9">-->
<!--                                                            <label>-->
<!--                                                                <input type="radio" name="per_docs" id="per_td_dni" class="flat-red" checked>DNI-->
<!--                                                            </label>-->
<!--                                                            <label>-->
<!--                                                                <input type="radio" name="per_docs" id="per_td_ruc" class="flat-red">RUC-->
<!--                                                            </label>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">N° Documento</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="p_dni" placeholder="Ingrese DNI"
                                                                   onkeypress="return numeros(event);" maxlength="8" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="div_per_pa">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Ap.Paterno</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="p_paterno" placeholder="Ingrese apellido paterno"
                                                                   onkeypress="return sololetras(event);">
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="div_per_ma">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Ap.Materno</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="p_materno" placeholder="Ingrese apellido materno"
                                                                   onkeypress="return sololetras(event);">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Nombres</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="p_nombres" placeholder="Ingrese nombres "
                                                                   onkeypress="return sololetras(event);">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Fecha Nac.</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group date ">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control pull-right" id="p_fnacimiento">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Sexo</label>

                                                        <div class="col-sm-9">
                                                            <label>
                                                                <input type="radio" name="p_sexo" id="p_masculino" class="flat-red" checked>M
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="p_sexo" id="p_femenino" class="flat-red">F
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Celular</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="p_celular" placeholder="Ingrese celular "
                                                                   maxlength="9" onkeypress="return numeros(event);">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">E-Mail</label>

                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control" id="p_email" placeholder="Ingrese e-correo ">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Dirección</label>

                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control" id="p_direccion" placeholder="Ingrese dirección ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Cambiar password</label>

                                                        <div class="col-sm-9">
                                                            <input type="checkbox" class="minimal" id="p_cambiar_password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Password</label>

                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control" id="p_password" placeholder="Ingrese Password "
                                                            disabled>
                                                        </div>
                                                    </div>
                                                    <div class="box-body box-profile">
                                                        <img class="profile-user-img img-responsive img-circle" src="../imagenes/user1-160x160.jpg" alt="User profile picture">

                                                        <h3 class="profile-username text-center" id="name_complet"></h3>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
<!--                                            <button type="button" onclick="" class="btn btn-default">Editar</button>-->
                                            <button type="button" onclick="edit_perfil()" class="btn btn-info pull-right">Guardar</button>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xs-2"></div>
            </div>
        </section>
    </div>

</div>

<div class="control-sidebar-bg"></div>
</div>

<?php include_once 'ext_scripts.php'; ?>
<script src="../js/login.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/perfil.js"></script>

</body>
</html>