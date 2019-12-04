<div class="modal modal-success fade" id="modal_premio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="premio_title">  </h4>
                <input type="text" style="display: none">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group" style="display:none">
                                    <input type="text" id="premio_id">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripcion</label>
                                    <input type="text" class="form-control" id="pre_descripcion" placeholder="Ingrese descripcion">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Stock</label>
                                    <input type="number"  class="form-control" id="pre_stock" placeholder="Ingrese stock">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Precio</label>
                                    <input type="number"  class="form-control" id="pre_precio" placeholder="Ingrese precio">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Pintrash</label>
                                    <input type="number"  class="form-control" id="pre_pintrash" placeholder="Ingrese pintrash">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Seleccione Foto</label>
                                    <input type="file" id="foto">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="pre_close">Cerrar</button>
                <button type="button" onclick="premio_add()" class="btn btn-outline pull-right">Guardar</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>