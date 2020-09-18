<!-- ================== BEGIN BASE JS ================== -->

<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js') }}"></script>


<!--[if lt IE 9]>

    <script src="../crossbrowserjs/html5shiv.js"></script>

    <script src="../crossbrowserjs/respond.min.js"></script>

    <script src="../crossbrowserjs/excanvas.min.js"></script>

  <![endif]-->

<script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('plugins/js-cookie/js.cookie.js') }}"></script>

<script src="{{ asset('js/theme/default.min.js') }}"></script>

<script src="{{ asset('js/apps.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/lib/moment.min.js') }}"></script>
@if (!empty($script['calendar'])):


<script src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>

<script src="{{ asset('js/demo/calendar.demo.js') }}"></script>
@endif;

<!-- ================== END BASE JS ================== -->



<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<!--   <script src="{{ asset('plugins/gritter/js/jquery.gritter.js') }}"></script>
 -->

<script src="{{ asset('plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>

<script src="{{ asset('plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/jszip.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/pdfmake.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.print.min.js') }}"></script>

<script src="{{ asset('plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('js/demo/table-manage-buttons.demo.js') }}"></script>

<script src="{{ asset('js/dataTables.fixedColumns.min.js') }}"></script>

<!-- Sweet Alert -->

<script src="{{ asset('plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>

<!--    <script src="{{ asset('js/demo/ui-modal-notification.demo.min.js') }}"></script> -->

<script src="{{ asset('js/list.js?v') . time() }}"></script>


@if (!empty($script['dashboard']))

<!-- Dashboard -->

<script src="{{ asset('plugins/flot/jquery.flot.min.js') }}"></script>

<script src="{{ asset('plugins/flot/jquery.flot.time.min.js') }}"></script>

<script src="{{ asset('plugins/flot/jquery.flot.resize.min.js') }}"></script>

<script src="{{ asset('plugins/flot/jquery.flot.pie.min.js') }}"></script>

<script src="{{ asset('plugins/sparkline/jquery.sparkline.js') }}"></script>

<script src="{{ asset('plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js"></script>
<script src="{{ asset('js/demo/dashboard.js') }}"></script>
<script src="{{ asset('plugins/nvd3/build/nv.d3.js') }}"></script>

<script src="{{ asset('js/demo/chart-d3.demo.js') }}"></script>

@endif


@if (!empty($script['gritter']))
<script src="{{ asset('plugins/gritter/js/jquery.gritter.min.js') }}"></script>
@endif



<!-- Date Picker -->

<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

<!-- Ion Range -->

<!--    <script src="{{ asset('plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
  -->
<!-- Color Picker -->

<!--     <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script> -->
<script src="{{ asset('plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>

<!-- Mask -->

<!--   <script src="{{ asset('plugins/masked-input/masked-input.min.js') }}"></script>

  Time Picker

  Password Indicator

  <script src="{{ asset('plugins/password-indicator/js/password-indicator.js') }}"></script>

  Combo Box

  <script src="{{ asset('plugins/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>

  Select

  <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>

  Tag

  <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

  <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js') }}"></script>

  <script src="{{ asset('plugins/jquery-tag-it/js/tag-it.min.js') }}"></script>
   -->


<!-- Date Range Picker -->

<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- Select 2 -->

<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>

<!-- Date Time Picker -->

<script src="{{ asset('plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}">
</script>

<!-- Color Picker -->

<!--   <script src="{{ asset('plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js') }}"></script>

  <script src="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js') }}"></script>

  Clipboard

  <script src="{{ asset('plugins/clipboard/clipboard.min.js') }}"></script> -->

<!-- Parsley -->

{{-- <script src="{{ asset('plugins/parsley/dist/parsley.js') }}"></script> --}}
<!--  <script src="{{ asset('plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>

   <script src="{{ asset('js\demo\form-wysiwyg.demo.js') }}"></script> -->

<!--   <script src="{{ asset('js/demo/ui-modal-notification.demo.min.js') }}"></script> -->


<!--
    <script src="{{ asset('plugins/highlight/highlight.common.js') }}"></script>

    <script src="{{ asset('js/demo/render.highlight.js') }}"></script>



    <script src="{{ asset('js/demo/form-plugins.demo.js') }}"></script>
 -->


<script src="{{ asset('plugins/character-counter/jquery.character-counter.js') }}"></script>


<!--
    <script src="{{ asset('js/bs-custom-file-input.min.js?') }}"></script> -->
<script type="text/javascript" src="{{ asset('plugins/fancyBox/source/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset('plugins/croppie/croppie.js') }}"></script>
<script src="{{ asset('plugins/clockpicker/clockpicker.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/dist/localization/messages_th.js') }}"></script>
<script src="{{ asset('js/form.js?v') . time() }}"></script>


@if (!empty($script['editor']))
<script src="{{ asset('ckeditor_full/ckeditor.js') }}"></script>
@endif


@if(!empty($script['dropzone']))
<script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
@endif

@if (!empty($script['treeview']) )

<script src="{{ asset('plugins/jstree/dist/jstree.min.js') }}"></script>

<script src="{{ asset('js/demo/ui-tree.demo.js') }}"></script>
<script src="{{ asset('js/treeview.js?v') . time() }}"></script>

@endif

@if (!empty($script['treeview_custom']))



@endif

@if (!empty($script['wizard']))

<script src="{{ asset('plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js') }}"></script>

<script src="{{ asset('js/demo/form-wizards-validation.demo.js') }}"></script>

@endif

@if (!empty($script['google_map']))

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

<script src="{{ asset('js/demo/map-google.demo.min.js') }}"></script>

@endif



@if (!empty($script['xxx']))

@endif


@if (!empty($script['cart']))
<script src="{{ asset('js/cart.js?v') . time() }}"></script>
@endif


@if (!empty($script['colorpicker']))
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
@endif


<!--
  <script src="{{ asset('plugins/lightbox/js/lightbox.min.js') }}"></script> -->

<script src="{{ asset('js/omise.js?v') . time() }}"></script>

<!-- <script src="{{ asset('js/utils.js?v') . time() }}"></script> -->

<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {

     $( "#logout" ).click(function() {

     swal({
          title: 'คุณต้องการออกจากระบบ ?',
          text: 'กดยืนยันเพื่อทำการออกระบบ',
          icon: 'warning',
          buttons: {
            cancel: {
              text: 'ยกเลิก',
              value: null,
              visible: true,
              className: 'btn btn-default',
              closeModal: true,
            },
            confirm: {
              text: 'ยืนยัน',
              value: true,
              visible: true,
              className: 'btn btn-warning',
              closeModal: true
            }

          }

        }).then(function (value) {
        switch (value) {
          case true:
          swal("ออกจากระบบเสร็จสมบูรณ์!", "", "success");
          setTimeout(function () {
            window.location.href = '/backend/auth/logout';
          }, 1500);
          break;
        }

      });

      return false;


    });

     App.init();
    @if (!empty($script['calendar']))
     Calendar.init();
    @endif

    @if (!empty($script['dashboard']))

      Dashboard.init();
      ChartNvd3.init();

    @endif

    @if (!empty($script['table']))

      TableManageButtons.init();

     /* Notification.init();*/

    @endif



     /* Highlight.init();*/

      //FormPlugins.init();

     /* Notification.init();*/

      /*BsCustomFileInput.init();*/

        // CustomForm.init();

        CustomDatepicker.init();

        // CustomAutocomplete.init();
        //FormWysihtml5.init();



      @if (!empty($script['editor']))

        //FormWysihtml5.init();

      @endif

      @if (!empty($script['treeview']))

        TreeView.init();
        //CustomTreeView.init();

      @endif

      @if (!empty($script['treeview_custom']))



      @endif

      @if (!empty($script['wizard']))

        FormWizardValidation.init();

      @endif

      @if (!empty($script['google_map']))

        MapGoogle.init();

      @endif

      @if (!empty($script['xxx']))

      @endif

    });

</script>
