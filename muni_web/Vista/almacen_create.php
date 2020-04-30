<div class="content-wrapper" id="venta_vista_crear"
     style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(255,255,255)95%);">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Almacén
            <small id="operation">Registro</small>
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
                        <h5 class="box-title" style="color: #01a189">Almacén</h5>
                        <input type="text" id="user_id" style="display: none">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-5">

                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Centro de Acopio Temporal</label>
                                    <select class="form-control select2" style="width: 100%;" id="a_combo_centro_acopio_t">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Sector</label>
                                    <select class="form-control" style="width: 100%;" id="a_sector">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Reciclador</label>
                                    <select class="form-control select2" style="width: 100%;" id="a_combo_reciclador">
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Tipo Residuo</label>
                                    <select class="form-control select2" style="width: 100%;" id="a_combo_tipo_residuo">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Peso kg.</label>
                                    <input type="number" class="form-control" id="a_txt_peso"
                                           placeholder="Ingrese peso en kg ">
                                </div>
                                <div>
                                    <div class="box-footer">
                                        <button type="button" onclick="add_almacen()" class="btn btn-foursquare pull-right">
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
                                                    <th>Residuo</th>
                                                    <th>Peso</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbla_detalle">
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
                                                <th>Peso Total:</th>
                                                <td id="a_total"></td>
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
                        <button type="button" class="btn btn-info pull-right" onclick="guardar_en_almacen()">Guardar</button>
                    </div>
                    <!-- /.box-footer -->


                </div>

            </div>
        </div>
    </section>

</div>