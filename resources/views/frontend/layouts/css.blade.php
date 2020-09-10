  <!-- ================== BEGIN BASE CSS STYLE ================== -->
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;600&display=swap" rel="stylesheet">

  <link href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap/4.0.0/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/font-awesome/5.0/css/fontawesome-all.min.css') }}" rel="stylesheet" />
  <!-- ================== END BASE CSS STYLE ================== -->

  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  @if(!empty($css['xxx']))
    
  @endif
  <!-- ================== END PAGE LEVEL STYLE ================== -->
  
  <link href="{{ asset('css/frontend/custom_style.css?v') . time() }}" rel="stylesheet" />
  <!-- fancybox3 -->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancyBox3/dist/jquery.fancybox.css') }}" media="screen">
