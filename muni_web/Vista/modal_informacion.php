<div class="modal modal-success fade" id="modal_informacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="informacion_title">  </h4>
                <input type="text" style="display: none">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form role="form" enctype="multipart/form-data" method="post" id="form_informacion">
                            <div class="box-body">
                                <div class="form-group" style="display:none">
                                    <input type="text" id="informacion_id" name="informacion_id">
                                    <input type="text" id="info_operation" name="info_operation">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titulo</label>
                                    <input type="text" class="form-control" id="info_titulo" placeholder="Ingrese titulo"
                                    name="info_titulo">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Descripcion</label>
                                    <textarea class="form-control" rows="3" placeholder="Descripcion ... "
                                              id="info_descripcion" name="info_descripcion"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Para:</label>

                                    <select name="" id="combo_rol" class="form-control" >
                                        <option value="0">Seleccione tipo</option>
                                        <option value="2">Reciclador</option>
                                        <option value="3">Proveedor</option>
                                    </select>
                                    <input type="text" id="info_rol" name="info_rol" style="display: none">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Seleccione Foto</label>
                                    <input type="file" id="info_foto" name="info_foto">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="info_close">Cerrar</button>
                <button type="button" onclick="informacion_add()" class="btn btn-outline pull-right">Guardar</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>