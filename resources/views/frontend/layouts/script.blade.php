<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/dist/localization/messages_th.js') }}"></script>
<!--[if lt IE 9]>
  <script src="../crossbrowserjs/html5shiv.js"></script>
  <script src="../crossbrowserjs/respond.min.js"></script>
  <script src="../crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('plugins/js-cookie/js.cookie.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->

@if (!empty($script['google_map'])) 
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
  <script src="{{ asset('js/demo/map-google.demo.min.js') }}"></script>
@endif

@if (!empty($script['xxx'])) 
@endif

<script src="{{ asset('js/frontend/script.js') }}"></script>
<!-- fancybox3 -->
<script src="{{ asset('plugins/fancyBox3/dist/jquery.fancybox.min.js') }}"></script>

<script>
</script>

  <!-- ================== END PAGE LEVEL JS ================== -->
