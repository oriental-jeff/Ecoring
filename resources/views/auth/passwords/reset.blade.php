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
          <li class="breadcrumb-item active" aria-current="page">{{ __('messages.forget_password') }}</li>
        </ol>
      </nav>
    </div>
  </section>

  <section class="mt-2 mb-5">
    <div class="container">
      <div class="box-paper border-top">
        <form class="form-horizontal" id="form-validate" action="{{ route('password.update') }}" method="POST">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="box-head">
            <h5>{{ __('messages.forget_password') }}</h5>
          </div>
          <div class="box-body text-left">
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.username') }} <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="email" placeholder="{{ __('messages.username_placeholder') }}" value="{{ request()->get('email') }}" readonly required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-8">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

              <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>

            <div class="row px-2 pb-5">
              <div class="col-6 px-1">
                <button type="reset" class="btn btn-secondary border-0 w-100">{{ __('messages.reset') }}</button>
              </div>
              <div class="col-6 px-1">
                <button type="submit" class="btn border-0 w-100">{{ __('messages.submit') }}</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
  $(document).ready(function() {
  });
</script>
@endpush
