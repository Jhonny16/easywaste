<div class="modal modal-default fade" id="modal-success-detalle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-cart-arrow-down text-white" aria-hidden="true"></i> Venta
                    Detalle</h4>
                <input type="text" style="display: none" id="sale_id">
            </div>
            <div class="modal-body">
                <div class="row">
<!--                    <div class="col-xs-12">-->
<!--                        <div class="form-group">-->
<!--                            <label>Centro Acopio Final</label>-->
<!--                            <select class="form-control select2" style="width: 100%;" id="combo_acopio_final">-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title">Número de comprobante : <span id="venta_code"> </span></h3>
                            </div>
                            <div class="box-body">
                                <div id="tabla_venta_detalle"></div>
                                <div class="table-responsive">
                                    <table class="table small">
                                        <tr>
                                            <th>Precio Total:</th>
                                            <td id="precio_total"></td>
                                        </tr>
                                    </table>
                                </div>

                                <!--                                <table class="table table-bordered table-hover">-->
                                <!--                                    <thead>-->
                                <!--                                    <tr>-->
                                <!--                                        <th>#</th>-->
                                <!--                                        <th>Residuo</th>-->
                                <!--                                        <th>Peso</th>-->
                                <!--                                        <th>Precio</th>-->
                                <!--                                        <th>Sub total</th>-->
                                <!--                                    </tr>-->
                                <!--                                    </thead>-->
                                <!--                                    <tbody id="tbl_modal_detalle">-->
                                <!--                                    </tbody>-->
                                <!--                                    <tfoot>-->
                                <!--                                    <div class="table-responsive">-->
                                <!--                                        <table class="table small">-->
                                <!--                                            <tr>-->
                                <!--                                                <th>Total:</th>-->
                                <!--                                                <td id="precio_total"></td>-->
                                <!--                                            </tr>-->
                                <!--                                        </table>-->
                                <!--                                    </div>-->
                                <!--                                    </tfoot>-->
                                <!--                                </table>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>