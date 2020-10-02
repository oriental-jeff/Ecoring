<!DOCTYPE html>
<html lang="{{ strtoupper(get_lang()) }}">
<head>
	<meta charset="utf-8" />
  <title>{{ config('global.site_title') }} - Commerce</title>
  <meta name="description" content="{{ $pages->{get_lang('meta_description')} ?? '' }}" />
  <meta name="keywords" content="{{ $pages->{get_lang('meta_keyword')} ?? '' }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="author" content="" />
  <meta name="copyright" content="" >
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/gif" sizes="16x16">
  
  <!-- begin content share -->
  @stack('og')
  <!-- end content share -->

  @if (!empty($css))
  @include('frontend.layouts.css', ['css' => $css])
  @else
    @include('frontend.layouts.css')
  @endif
  @stack('after-css')

  <script>
    var base_url = '{!! url("/") !!}';
  </script>
</head>
<body>

  <!-- begin #header -->
  <header>
    @include('frontend.layouts.header')
  </header>
  <div id="firstbox"></div>
  <!-- end #header -->

  <!-- begin #content -->
  @yield('content')
  <!-- end #content -->

  <!-- begin #footer -->
  <footer>
    @include('frontend.layouts.footer')
  </footer>
  <div class="box-search-shadow"></div>
  <!-- end #footer -->

@if(!empty($script))
  @include('frontend.layouts.script', ['script' => $script])
@else
  @include('frontend.layouts.script')
@endif
@stack('after-scripts')

</body>
</html>
