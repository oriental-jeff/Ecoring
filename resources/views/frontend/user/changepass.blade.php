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
				    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.edit_password') }}</li>
				  </ol>
				</nav>
			</div>
    </section>
	        
    <section class="mt-2 mb-5">
  		<div class="container">
  			<div class="box-paper border-top">
  				<form class="form-horizontal" method="post" id="form-validate" name="demo-form" accept-charset="utf-8" action="{{ route('frontend.user.update', ['locale' => get_lang(), 'user' => $user->id]) }}">
            @method('patch')
            @csrf
  					<div class="box-head">
  						<h5>{{ __('messages.edit_password') }}</h5>
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
                <label for="old_password">{{ __('messages.old_password') }}</label>
  							<input type="password" class="form-control" id="old_password" name="old_password" required="">
  							<hr>
  						</div>
  						<div class="form-group">
                <label for="password">{{ __('messages.new_password') }}</label>
						    <div class="btn-eye-slash">
							    <i></i>
							    <input type="password" class="form-control" id="password" name="password" required="">
						    </div>
						    <small class="form-text text-muted text-color">{{ __('messages.password_noti') }}</small>
  						</div>
  						<div class="form-group">
						    <label for="password_confirmation">{{ __('messages.confirm_new_password') }}</label>
						    <div class="btn-eye-slash">
							    <i></i>
							    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required="">
						    </div>
						    <small class="form-text text-muted text-color">{{ __('messages.confirm_password_noti') }}</small>
  						</div>
  						<div class=" row px-2 pb-5">
  							<div class="col-6 px-1">
  								<a href="{{ route('frontend.user.profile', ['locale' => get_lang()]) }}" class="btn btn-secondary border-0 w-100">{{ __('messages.reset') }}</a>
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
    $(".btn-eye-slash i").click(function() {
      $(this).toggleClass('active');
      var pwdType = $(this).find('+input').attr("type");
      var newType = (pwdType === "password")?"text":"password";
      $(this).find('+input').attr("type", newType);
    });

    $("#form-validate").validate({
      rules : {
        password_confirmation : {
          equalTo : "#password"
        }
      },
      errorPlacement: function(error, element) {
        error.insertAfter(element);
      },
      invalidHandler: function(form, validator) {
        if (!validator.numberOfInvalids()) {
          return;
        } else {
          $('html, body').animate({
            scrollTop: ($(validator.errorList[0].element).offset().top - 200)
          }, 500);
        }
      }
    });
  });
  </script>
@endpush

