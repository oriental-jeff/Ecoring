<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>{{ config('global.site_title') }}</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />

  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/gif" sizes="16x16">

  @if (!empty($css))
    @include('backend.layouts.css', ['css' => $css])
  @else
    @include('backend.layouts.css')
  @endif

  <script>
    var base_url = '{{ url("home") }}';
  </script>
</head>

<body>
    @if (!empty($css) && !empty($css['font']) && $css['font'] == 'K2D')
        <style>
            body { font-family: 'K2D', sans-serif; }
        </style>
    @endif
  <style>
    a.dropdown-item.active:hover { background-color: #007bff; }
  </style>

  <!-- begin #page-loader -->
  <div id="page-loader" class="fade show"><span class="spinner"></span></div>
  <!-- end #page-loader -->
  <!-- begin #page-container -->
  <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar-default">
      <!-- begin navbar-header -->
      <div class="navbar-header">
        <div style="padding: 10px; width: 60%;">
          <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid" style="max-height: 60px; width: auto;">
        </div>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- end navbar-header -->

      <!-- begin header-nav -->
      <ul class="navbar-nav navbar-right">
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle" aria-hidden="true" title='{{ Auth::user()->first_name }}'></i>
            <span class="d-none d-md-inline ml-1"> {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span> <b class="caret"></b>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('backend.auth.logout') }}" class="dropdown-item" title='ออกจากระบบ' onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt" aria-hidden="true"></i> <span class='d-none d-md-inline ml-1'>ออกจากระบบ</span>
            </a>
            <form id="logout-form" action="{{ route('backend.auth.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
      <!-- end header navigation right -->
    </div>
    <script>
      var base_url = "{{ url('/') }}"
    </script>
    <!-- end #header -->
    @include('backend.layouts.sidebar')
    <!-- begin #content -->
    <div id="content" class="content">
      <!-- begin #action message -->
      @if(Session::has('message'))
        <div id="alert_box" class="alert {{ Session::get('alert-class', 'alert-light') }} py-2">
          <b>{{ Session::get('message') }}</b>
        </div>
      @endif
      <!-- end #action message -->
        <h1 class="page-header">
            @yield('title', 'Page Header Title')
        </h1>
      @yield('content')
    </div>
    <!-- end #content -->
  </div>
  <!-- end page container -->

  @if(!empty($script))
    @include('backend.layouts.script', ['script' => $script])
  @else
    @include('backend.layouts.script')
  @endif
  @stack('after-scripts')

</body>
</html>
