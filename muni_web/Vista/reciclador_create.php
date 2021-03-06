<div class="content-wrapper" id="reciclador_vista_nuevo"
     style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(255,255,255)95%);">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reciclador
            <small id="operation">Nuevo</small>
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
                        <h5 class="box-title" style="color: #00a65a">Nuevo Reciclador</h5>
                        <input type="text"  id="user_id" style="display: none">
                        <input type="text" id="reciclador_id"  style="display: none">
                    </div>
                    <!-- /.box-header -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <input type="text" id="fecha_hoy" value="<?php date_default_timezone_set("America/Lima");
                                    echo date('Y-m-d');?>" style="display: none">
<!--                                    <div class="form-group">-->
<!--                                        <label for="inputEmail3" class="col-sm-3 control-label">TIPO DOC.</label>-->
<!---->
<!--                                        <div class="col-sm-9">-->
<!--                                            <label>-->
<!--                                                <input type="radio" name="rec_docs" id="rec_td_dni" class="flat-red" checked>DNI-->
<!--                                            </label>-->
<!--                                            <label>-->
<!--                                                <input type="radio" name="rec_docs" id="rec_td_ruc" class="flat-red">RUC-->
<!--                                            </label>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">DNI</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="rec_dni" placeholder="Ingrese número de documento"
                                                   maxlength="8"
                                                   onkeypress="return numeros(event);"  >
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_rec_pa">
                                        <label for="inputEmail3" class="col-sm-3 control-label">AP. PATERNO</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="rec_appaterno" placeholder="Ingrese apellido paterno"
                                                   onkeypress="return sololetras(event);">
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_rec_ma">
                                        <label for="inputEmail3" class="col-sm-3 control-label">AP. MATERNO</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="rec_apmaterno" placeholder="Ingrese apellido materno"
                                                   onkeypress="return sololetras(event);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">NOMBRES</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="rec_nombres" placeholder="Ingrese nombres "
                                                   onkeypress="return sololetras(event);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">FECHA NAC.</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date ">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="rec_fn" ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">SEXO</label>

                                        <div class="col-sm-9">
                                            <label>
                                                <input type="radio" name="rec_estado" id="rec_m" class="flat-red" checked>M
                                            </label>
                                            <label>
                                                <input type="radio" name="rec_estado" id="rec_f" class="flat-red">F
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">CELULAR</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="rec_celular" placeholder="Ingrese celular "
                                                   maxlength="9" onkeypress="return numeros(event);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">E-MAIL</label>

                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="rec_email" placeholder="Ingrese e-correo ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">ESTADO</label>

                                        <div class="col-sm-9">
                                            <label>
                                                <input type="radio" name="rec_estados" id="rec_a" class="flat-red" checked>Activo
                                            </label>
                                            <label>
                                                <input type="radio" name="rec_estados" id="rec_i" class="flat-red">Inactivo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Es proveedor?</label>

                                        <div class="col-sm-9">
                                            <input type="checkbox" class="minimal" id="rec_es_proveedor">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">ZONA</label>
                                        <div class="col-sm-10">
                                                <select class="form-control select2" style="width: 100%;" id="combo_zona">
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">DIRECCIÓN</label>

                                        <div class="col-sm-10">
                                            <input id="pac-input" class="controls" type="text" placeholder="Ingrese Dirección">
                                            <div id="map_direcciones"></div>
                                        </div>
<!--                                        <div id="map_direcciones" style=" height:300px;width: 80%;float: left;">-->
<!---->
<!--                                        </div>-->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Cancel</button>
                            <button type="button" onclick="reciclador_add()" class="btn btn-info pull-right">Guardar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>


                </div>

            </div>
        </div>

</div>