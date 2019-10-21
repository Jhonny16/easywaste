<div class="content-wrapper" id=""
     style="background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Periodos
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
                        <h5 class="box-title" style="color: #01a189">Lista de Períodos</h5>
                        <input type="text"  id="user_id" style="display: none">
                        <div class="box-tools pull-right">
                            <button type="button" id="btn_nuevo_periodo"
                                    class="btn btn-block btn-info" data-toggle="modal" data-target="#mdl_periodo">
                                <i class="fa fa-plus"> Nuevo</i></button>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div  id="listado_periodos"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
<!--                            <button type="submit" class="btn btn-default">Cancel</button>-->
<!--                            <button type="button" onclick="" class="btn btn-info pull-right">Guardar</button>-->
                        </div>
                        <!-- /.box-footer -->
                    </form>


                </div>

            </div>
        </div>

</div>