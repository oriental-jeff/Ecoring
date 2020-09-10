  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap/4.0.0/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/font-awesome/5.14/css/all.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/animate/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/default/style.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/default/style-responsive.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/backend/theme/purple.css') }}" rel="stylesheet" id="theme" />
  <!-- ================== END BASE CSS STYLE ================== -->

  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <!-- <link href="{{ asset('plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" /> -->
  <link href="{{ asset('plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' />
  <link href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />
  @if(!empty($css['gritter']))
    <link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" /> 
  @endif
  <link href="{{ asset('plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/fancyBox/source/jquery.fancybox.css') }}" rel="stylesheet" />

  <!-- Date Picker -->
  <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />

  <!-- Time Picker -->
  <link href="{{ asset('plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />

  <!-- Select -->
   <!--  <link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
   -->
  <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/clockpicker/clockpicker.css') }}" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <link href="{{ asset('css/backend/custom.css?v') . time() }}" rel="stylesheet" />

  <!-- ================== BEGIN BASE JS ================== -->
@if (!empty($css['dashboard'])) 
    <link href="{{ asset('plugins/jquery-jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/nvd3/build/nv.d3.css') }}" rel="stylesheet" />
@endif

@if (!empty($css['treeview']))
  <link href="{{ asset('/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" />
@endif

@if (!empty($css['dropzone']))
  <link href="{{ asset('/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
@endif

@if (!empty($css['colorpicker']))
  <link href="{{ asset('/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
@endif
