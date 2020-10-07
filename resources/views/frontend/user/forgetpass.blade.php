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
					<form class="form-horizontal" id="form-validate" action="/api/v1/password/forgot" method="POST">
            <div class="box-head">
              <h5>{{ __('messages.forget_password') }}</h5>
            </div>
            <div class="box-body text-left">
              @if(Session::has('message'))
                <div id="alert_box" class="alert {{ Session::get('alert-class', 'alert-light') }} py-2">
                  <b>{{ Session::get('message') }}</b>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <div class="form-group">
                <label for="email">{{ __('messages.username') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" placeholder="{{ __('messages.username_placeholder') }}" value="{{ request()->get('email') }}" required="">
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
    $("#form-validate").validate({
      rules : {
        password_confirmation : {
          equalTo : "#password"
        }
      },
      errorPlacement: function(error, element) {
        if (element.attr("name") == "privacy_confirm") {
          // error.insertAfter($(element).parent());
        } else {
          error.insertAfter(element);
        }
      },
      invalidHandler: function(form, validator) {
        if (!validator.numberOfInvalids()) {
          return;
        } else {
          $('html, body').animate({
            scrollTop: ($(validator.errorList[0].element).offset().top - 150)
          }, 500);
        }
      }
    });
  });
  </script>
@endpush
