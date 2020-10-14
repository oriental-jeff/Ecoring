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
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.home', ['locale' => get_lang()]) }}">Home</a></li>
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
                        <form method="post" id="form-validate"
                            action="{{ route('frontend.auth.login', ['locale' => get_lang()]) }}"
                            class="px-5 pt-5 pb-3 m-auto" style="max-width: 500px;">
                            @csrf

                            @if(Session::has('message'))
                            <div id="alert_box" class="alert {{ Session::get('alert-class', 'alert-light') }} py-2">
                                <b>{{ Session::get('message') }}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="form-group icon-User">
                                <label for="email">{{ __('messages.username') }} ({{ __('messages.email') }})</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp" placeholder="{{ __('messages.username_placeholder') }}"
                                    @error('email') is-invalid @enderror value="{{ old('email') }}" required="">
                            </div>
                            <div class="form-group icon-Password">
                                <label for="password">{{ __('messages.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ __('messages.password_placeholder') }}" @error('password')
                                    is-invalid @enderror required="">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember_checkbox" name="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="remember_checkbox">{{ __('messages.remember_me') }}</label>
                                <a href="{{ route('frontend.password.reset', ['locale' => get_lang()]) }}"
                                    class="float-right"><u>{{ __('messages.forget_password') }} ?</u></a>
                            </div>
                            <br>
                            <button type="submit"
                                class="btn btn-secondary border-0 d-block m-auto px-4">{{ __('messages.login') }}</button>
                        </form>
                        <hr class="w-75">
                        <div class="px-5 pt-1 pb-5 m-auto row" style="max-width: 500px;">
                            <div class="col-sm-6 p-1">
                                <a href="{{ route('frontend.auth.provider', ['locale' => get_lang(), 'provider' => 'facebook']) }}"
                                    class="btn-face"><img
                                        src="{{ asset('images/btn-face.jpg') }}">{{ __('messages.login') }} Facebook</a>
                            </div>
                            <div class="col-sm-6 p-1">
                                <a href="{{ route('frontend.auth.provider', ['locale' => get_lang(), 'provider' => 'line']) }}"
                                    class="btn-line"><img
                                        src="{{ asset('images/btn-line.jpg') }}">{{ __('messages.login') }} Line</a>
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
                        <a href="{{ route('frontend.register', ['locale' => get_lang()]) }}"
                            class="btn btn-secondary border-0 d-table m-auto px-4">{{ __('messages.register') }}</a>
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
