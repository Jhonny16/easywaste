<div class="modal modal-success fade" id="mdl_periodo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <p><input type="text"  id="txtperiodo_id" style="display:none"></p>
                <h4 class="modal-title" id="periodo_title_modal"></h4>
                <p>
                    <input type="hidden" value="" id="txtperiodo_toperacion" name="txtproducto_toperacion">
                </p>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert" id="periodo_v" style="display: none">
                        No puede editar un periodo que ya estuvo Vigente.
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Fec. Inicio</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="periodo_fecha_inicio"
                                   id="periodo_fecha_inicio" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Fec. Fin</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="periodo_fecha_fin"
                                   id="periodo_fecha_fin" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Descripción</label>
                        <div class="col-sm-10">
                            <input type="text" min="0" class="form-control" name="periodo_descripcion"
                                   id="periodo_descripcion" onkeypress="return sololetras(event);" required="" maxlength="200">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Activo</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="periodo_estado" class="flat-red"
                                           id="periodo_activo"
                                           value="1" > SI
                                </label>
                                <label>
                                    &nbsp;&nbsp;<input type="radio" class="flat-red"
                                                       name="periodo_estado"
                                                       id="periodo_noactivo"
                                                       value="0" checked> NO
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" id="btnproducto_close" class="btn btn-outline pull-left"
                            data-dismiss="modal">
                        <i class="fa fa-close"></i> Cerrar
                    </button>
                    <button type="button" class="btn btn-outline" onclick="periodo_add()">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </form>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>