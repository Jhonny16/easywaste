<div class="content-wrapper" id="proveedor_vista_nuevo"
     style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Proveedor
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
                        <h5 class="box-title" style="color: #01a189">Nuevo Proveedor!</h5>
                        <input type="text"  id="user_id" style="display: none">
                        <input type="text" id="proveedor_id"  style="display: none">
                    </div>
                    <!-- /.box-header -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">DNI</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pro_dni" placeholder="Ingrese DNI"
                                                   onkeypress="return numeros(event);" maxlength="8" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">AP. PATERNO</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pro_appaterno" placeholder="Ingrese apellido paterno"
                                                   onkeypress="return sololetras(event);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">AP. MATERNO</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pro_apmaterno" placeholder="Ingrese apellido materno"
                                                   onkeypress="return sololetras(event);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">NOMBRES</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pro_nombres" placeholder="Ingrese nombres "
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
                                                <input type="text" class="form-control pull-right" id="pro_fn">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">SEXO</label>

                                        <div class="col-sm-9">
                                            <label>
                                                <input type="radio" name="pro_estado" id="pro_m" class="flat-red" checked>M
                                            </label>
                                            <label>
                                                <input type="radio" name="pro_estado" id="pro_f" class="flat-red">F
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">CELULAR</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pro_celular" placeholder="Ingrese celular "
                                                   maxlength="9" onkeypress="return numeros(event);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">E-MAIL</label>

                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="pro_email" placeholder="Ingrese e-correo ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">ESTADO</label>

                                        <div class="col-sm-9">
                                            <label>
                                                <input type="radio" name="pro_estados" id="pro_a" class="flat-red" checked>Activo
                                            </label>
                                            <label>
                                                <input type="radio" name="pro_estados" id="pro_i" class="flat-red">Inactivo
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">ZONA</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" id="pro_combo_zona">
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
                            <button type="button" onclick="proveedor_add()" class="btn btn-info pull-right">Guardar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>


                </div>

            </div>
        </div>

</div>