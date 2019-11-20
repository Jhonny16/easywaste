<!-- jQuery 3 -->

<script src="../util/lte/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../util/lte/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../util/lte/select2/dist/js/select2.full.min.js"></script>

<!--<link href="../util/lte/select2/dist/js/select2.full.min.js" />-->

<!-- FastClick -->
<script src="../util/lte/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<!--<script src="../util/lte/js/adminlte.min.js"></script>-->
<!-- Sparkline -->
<script src="../util/lte/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- date-range-picker -->
<script src="../util/lte/moment/min/moment.min.js"></script>
<script src="../util/lte/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../util/lte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../util/lte/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../util/lte/iCheck/icheck.min.js"></script>
<!-- bootstrap time picker -->
<script src="../util/lte/timepicker/bootstrap-timepicker.min.js"></script>
<!-- InputMask -->
<script src="../util/lte/input-mask/jquery.inputmask.js"></script>
<script src="../util/lte/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../util/lte/input-mask/jquery.inputmask.extensions.js"></script>
<!-- SlimScroll -->
<script src="../util/lte/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="../util/lte/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE App -->
<script src="../util/lte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../util/lte/js/demo.js"></script>
<!-- DataTables -->
<script src="../util/lte/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../util/lte/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!--<script src="sweetalert2.all.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.1/dist/sweetalert2.all.min.js"
        integrity="sha256-hHbPuouD0xnkYPlQWBHAWr4hkFP9fEbiIDpsDxd7SQc=" crossorigin="anonymous"></script>


<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();


        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        $('#regla_picker').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Ultimo Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Ultimo Año': [moment().subtract(1, 'years'), moment()],
                    'Ultimos 4 Años': [moment().subtract(4, 'years'), moment()],
                    'Ultimos 5 Años': [moment().subtract(5, 'years'), moment()]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

            }
        )
        $('#dateproductos').daterangepicker(
            {
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Ultimo Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Ultimo Año': [moment().subtract(1, 'years'), moment()],
                    'Ultimos 4 Años': [moment().subtract(4, 'years'), moment()],
                    'Ultimos 5 Años': [moment().subtract(5, 'years'), moment()]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#dateproductos span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

            }
        )
        $('#datepedidos').daterangepicker(
            {
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Ultimo Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Ultimo Año': [moment().subtract(1, 'years'), moment()],
                    'Ultimos 4 Años': [moment().subtract(4, 'years'), moment()],
                    'Ultimos 5 Años': [moment().subtract(5, 'years'), moment()]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#dateproductos span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //Date picker
        $('#rec_fn').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        })
        $('#pro_fn').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        })
        // $('#pro_fn').inputmask('yyyy-mm-dd', {'placeholder': 'yyyy-mm-dd'})

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>
<script src="../js/validate_login.js"></script>

