@extends('frontend.layouts.main')
@push('after-css')
@endpush
@section('title')
@endsection

@section('content')
  <!-- begin #content -->
  <div id="content" class="content">
    <section class="box-breadcrumb d-none d-md-block">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home', ['locale' => get_lang()]) }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.login') }}</li>
          </ol>
        </nav>
      </div>
    </section>
          
    <section class="mt-2 mb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 p-0">
            <div class="box-paper border-top">
              <form action="#" class="px-5 pt-5 pb-3 m-auto" style="max-width: 500px;">
                <div class="form-group icon-User">
                    <label for="exampleInputEmail1">{{ __('messages.username') }} ({{ __('messages.email') }})</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ __('messages.username_placeholder') }}">
                </div>
                <div class="form-group icon-Password">
                    <label for="exampleInputPassword1">{{ __('messages.password') }}</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="{{ __('messages.password_placeholder') }}">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">{{ __('messages.remember_me') }}</label>
                    
                    <a href="forgetpass.php" class="float-right"><u>{{ __('messages.forget_password') }} ?</u></a>
                </div>
                <br>
                <button type="submit" class="btn btn-secondary border-0 d-block m-auto px-4">{{ __('messages.login') }}</button>
              </form>
              <hr class="w-75">
              <div class="px-5 pt-1 pb-5 m-auto row" style="max-width: 500px;">
                <div class="col-sm-6 p-1">
                  <a href="#" class="btn-face"><img src="{{ asset('images/btn-face.jpg') }}">{{ __('messages.login') }} Facebook</a>
                </div>
                <div class="col-sm-6 p-1">
                  <a href="#" class="btn-line"><img src="{{ asset('images/btn-line.jpg') }}">{{ __('messages.login') }} Line</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 p-0 box-register d-flex">
            <div class="text-center align-self-center m-auto py-5">
              <div class="footer-box">
                <img src="{{ asset('images/icon-footer/box4.svg') }}">
              </div>
              <p>{{ __('messages.register_noti1') }}<br>{{ __('messages.register_noti2') }}</p>
              <hr class="w-100 border-white my-4">
              <a href="{{ route('frontend.register', ['locale' => get_lang()]) }}" class="btn btn-secondary border-0 d-table m-auto px-4">{{ __('messages.register') }}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end #content -->
@endsection

@push('after-scripts')
@endpush
