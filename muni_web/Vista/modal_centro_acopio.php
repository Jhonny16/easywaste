<div class="modal modal-success fade" id="modal_ca">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ca_title">  </h4>
                <input type="text" style="display: none">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group" style="display:none">
                                    <input type="text" id="ca_id" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="ca_nombre" placeholder="Ingrese nombre"
                                           name="ca_nombre">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dirección</label>
                                    <input type="text" class="form-control" id="ca_direccion" placeholder="Ingrese dirección"
                                           name="ca_direccion">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tipo</label>

                                    <select name="" id="combo_type" class="form-control" >
                                        <option value="Temporal">Temporal</option>
                                        <option value="Final">Final</option>
                                    </select>
                                </div>

                                <div class="form-group" id="div_numero_sectores">
                                    <label for="exampleInputEmail1">N° Sectores</label>
                                    <input type="number" class="form-control" id="ca_numero_sectores"
                                           max="10" maxlength="2" min="1"
                                           name="ca_numero_sectores">
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="ca_close">Cerrar</button>
                <button type="button" onclick="centro_acopio_add()" class="btn btn-outline pull-right">Guardar</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>