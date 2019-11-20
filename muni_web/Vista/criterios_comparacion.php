    <div class="content-wrapper" id="reciclador_vista_nuevo"
         style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Criterios
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
                            <h5 class="box-title" style="color: #01a189">Comparación de Criterios</h5>
                            <input type="text"  id="user_id" style="display: none">
                            <input type="text" id="reciclador_id"  style="display: none">
                        </div>
                        <!-- /.box-header -->
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">NOTA:</h3>

                                                <div class="box-tools">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="box-body no-padding">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li>
                                                        <a href="#"><i class="fa fa-circle-o text-light-blue">
                                                            </i> 1. Seleccionar pesos para realizar la comparacion de los criterios para asignacion de valores.
                                                        </a>
    <!--                                                    <a href="#" id="aviso">-->
    <!--                                                        <i class="fa fa-circle-o text-light-blue">-->
    <!--                                                            <div class="alert alert-info alert-dismissible">-->
    <!--                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
    <!--                                                                <h4><i class="icon fa fa-info"></i> Aviso!</h4>-->
    <!--                                                                <p id="mensaje"></p>-->
    <!--                                                            </div>-->
    <!--                                                        </i>-->
    <!--                                                    </a>-->
                                                        <a href="#"><i class="fa fa-circle-o text-light-blue">
                                                            </i> 2. Para actualizar los pesos de los criterios es necesario ingresar el código de verificación
                                                            <button type="button" id="btn_code"
                                                                    class="btn btn-block btn-info" data-toggle="modal" data-target="#mdl_code">
                                                                <i class="fa fa-recycle"> </i> Evaluar</button>
                                                        <a href="#"><i class="fa fa-circle-o text-light-blue">
                                                            </i> 3. Generar matrices y pesos para cada criterio.
                                                        <button id="generar_algoritmo" style="display: none" type="button" class="btn btn-block btn-success" onclick="generate_algorit()">Generar</button></a>

                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div  id="criterios_comparacion"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">PESOS ASIGNADOS A LOS CRITERIOS:</h3>

                                                <div class="box-tools">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="box-body no-padding">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a href="#"><i class="fa fa-circle-o text-light-blue">
                                                            </i> 1. Luego de cálculos y creación de tablas internas por medio del algoritmo AHP, se generó
                                                            los pesos para cada uno de los criterios.</a>
                                                        <a href="#"><i class="fa fa-circle-o text-light-blue">
                                                            </i> 2. Si estamos conformes con los resultados de los pesos, click en Guardar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div  id="criterios_values"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Cancel</button>
                                <button id="guardar_criterios" type="button" onclick="criterios_values_save()" class="btn btn-info pull-right">Guardar</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>


                    </div>

                </div>
            </div>

    </div>