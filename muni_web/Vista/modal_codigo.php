<div class="modal modal-success fade" id="mdl_code">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_mdl_code">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="periodo_title_modal">Ingrese Código</h4>
                <p>
                    <input type="hidden" value="">
                </p>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">CÓDIGO</label>
                        <div class="col-sm-10">
                            <input type="text" min="0" class="form-control"
                                   id="code_insert" required="" maxlength="6">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnproducto_close" class="btn btn-outline pull-left"
                            data-dismiss="modal">
                        <i class="fa fa-close"></i> Cerrar
                    </button>
                    <button type="button" class="btn btn-outline" onclick="code_evalue()">
                        <i class="fa fa-save"></i> Validar
                    </button>
                </div>
            </form>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>