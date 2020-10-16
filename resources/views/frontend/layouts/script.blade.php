<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.js') }}"></script>
@if (get_lang() == 'th')
  <script src="{{ asset('plugins/jquery-validation/dist/localization/messages_th.js') }}"></script>
@endif
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

<script src="{{ asset('plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/frontend/script.js') }}"></script>
<!-- owl.carousel -->
<script type="text/javascript" src="{{ asset('plugins/owlcarousel/owl.carousel.js') }}"></script>
<!-- fancybox3 -->
<script src="{{ asset('plugins/fancyBox3/dist/jquery.fancybox.min.js') }}"></script>
<!-- datepicker -->
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  var datefield=document.createElement("input")
  datefield.setAttribute("type", "date")
  if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
  }
	if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
	    jQuery(function($){ //on document.ready
		    $('input[type="date"]').datepicker({ dateFormat: 'dd/mm/yy' });
	    })
	}
</script>

<!-- Your customer chat facebook code -->
<script>
    // START : MESSENGER FACEBOOK SCRIPT
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v3.2'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    // END : MESSENGER FACEBOOK SCRIPT
</script>

<script>
</script>

<!-- ================== END PAGE LEVEL JS ================== -->
