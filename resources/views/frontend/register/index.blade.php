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
				    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.register') }}</li>
				  </ol>
				</nav>
			</div>
    </section>
	        
    <section class="mt-2 mb-5">
			<div class="container">
				<h4 class="mx-auto mb-4" style="max-width: 1000px;">{{ __('messages.register') }}</h4>
				<div class="box-paper border-top">
          <form class="form-horizontal" method="post" id="form-validate" name="demo-form" accept-charset="utf-8" action="{{ route('frontend.user.store', ['locale' => get_lang()]) }}">
            @method('post')
            @csrf
						<div class="box-head text-left pb-2">
							<h5 style="color: #00b16b;"><i class="iClause">1</i> {{ __('messages.data_account') }}</h5>
							<div class="form-row">
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="username" style="color: #212529;">{{ __('messages.username') }} <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="username" name="username" placeholder="{{ __('messages.username_placeholder') }}" required="">
								</div>
							</div>
							<div class="form-row">
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="password" style="color: #212529;">{{ __('messages.password') }} <span class="text-danger">*</span></label>
									<input type="password" class="form-control" id="password" name="password" placeholder="{{ __('messages.password_placeholder') }}" required="">
									<small class="form-text text-muted text-color">{{ __('messages.password_noti') }}</small>
								</div>
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="confirm_password" style="color: #212529;">{{ __('messages.confirm_password') }} <span class="text-danger">*</span></label>
									<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="{{ __('messages.password_placeholder') }}" required="">
									<small class="form-text text-muted text-color">{{ __('messages.confirm_password_noti') }}</small>
								</div>
							</div>
						</div>
						<div class="box-body text-left" style="max-width:none;">
							<h5 style="color: #00b16b;"><i class="iClause">2</i> {{ __('messages.data_profile') }}</h5>
							<div class="form-row">
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="first_name">{{ __('messages.name') }} <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="first_name" name="first_name" required="">
								</div>
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="last_name">{{ __('messages.surname') }} <span class="text-danger">*</span></label>
									<input type="tel" class="form-control" id="last_name" name="last_name" required="">
								</div>
							</div>
							<div class="form-row">
								<div class="col-lg-5 col-md-6 mb-3">
									<label class="w-100">{{ __('messages.sex') }}</label>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" id="sex1" name="sex" value="1" checked>
										<label class="form-check-label" for="sex1">{{ __('messages.men') }}</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" id="sex2" name="sex" value="2">
										<label class="form-check-label" for="sex2">{{ __('messages.women') }}</label>
									</div>
								</div>
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="birthday">{{ __('messages.birthday') }}</label>
									<input type="date" class="form-control" id="birthday" name="birthday">
								</div>
							</div>
							<div class="form-row">
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="telephone">{{ __('messages.telephone') }} <span class="text-danger">*</span></label>
									<input type="tel" class="form-control" id="telephone" name="telephone" required="">
								</div>
								<div class="col-lg-5 col-md-6 mb-3">
									<label for="email">{{ __('messages.email') }} <span class="text-danger">*</span></label>
									<input type="email" class="form-control" id="email" name="email" required="">
								</div>
							</div>
							<hr>
							
							<h5 style="color: #00b16b;"><i class="iClause">3</i> {{ __('messages.data_address') }}</h5>
							<div class="form-row">
								<div class="col-lg-6 col-md-6 mb-3">
									<label for="address">{{ __('messages.address') }} <span class="text-danger">*</span></label>
									<textarea class="form-control" id="address" name="address" required=""></textarea>
								</div>
								<div class="col-lg-3 col-md-6 mb-3">
									<label for="sub_district">{{ __('messages.sub_district') }} <span class="text-danger">*</span></label>
									<select class="form-control" id="sub_district" name="sub_district" required="">
										<option value="">{{ __('messages.please_select') }}</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="col-lg-3 col-md-6 mb-3">
									<label for="district">{{ __('messages.district') }} <span class="text-danger">*</span></label>
									<select class="form-control" id="district" name="district" required="">
										<option value="">{{ __('messages.please_select') }}</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="col-lg-4 col-md-6 mb-3">
									<label for="province">{{ __('messages.province') }} <span class="text-danger">*</span></label>
									<select class="form-control" id="province" name="province" required="">
										<option value="">{{ __('messages.please_select') }}</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="col-lg-4 col-md-6 mb-3">
									<label for="postcode">{{ __('messages.postcode') }} <span class="text-danger">*</span></label>
									<input type="tel" class="form-control" id="postcode" name="postcode" required="">
								</div>
							</div>
							<br>
							
							<h5 style="color: #00b16b;"><i class="iClause">4</i> {{ __('messages.data_address_delivery') }}</h5>
							<div class="form-row" id="boxAddress2">
								<div class="col-12 mb-3">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" id="check_current_address" name="current_address" checked>
										<label class="form-check-label font-weight-light" for="check_current_address"> {{ __('messages.use_same_address') }}</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 mb-3">
									<label for="logistic_address">{{ __('messages.address') }} <span class="text-danger">*</span></label>
									<textarea class="form-control readonly" id="logistic_address" name="logistic_address" required="" readonly></textarea>
								</div>
								<div class="col-lg-3 col-md-6 mb-3">
									<label for="logistic_sub_district">{{ __('messages.sub_district') }} <span class="text-danger">*</span></label>
									<select class="form-control readonly" id="logistic_sub_district" name="logistic_sub_district" readonly>
										<option>{{ __('messages.please_select') }}</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="col-lg-3 col-md-6 mb-3">
									<label for="logistic_district">{{ __('messages.district') }} <span class="text-danger">*</span></label>
									<select class="form-control readonly" id="logistic_district" name="logistic_district" readonly>
										<option>{{ __('messages.please_select') }}</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="col-lg-4 col-md-6 mb-3">
									<label for="logistic_province">{{ __('messages.province') }} <span class="text-danger">*</span></label>
									<select class="form-control readonly" id="logistic_province" name="logistic_province" readonly>
										<option>{{ __('messages.please_select') }}</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="col-lg-4 col-md-6 mb-3">
									<label for="logistic_postcode">{{ __('messages.postcode') }} <span class="text-danger">*</span></label>
									<input type="tel" class="form-control readonly" id="logistic_postcode" name="logistic_postcode" required="" readonly>
								</div>
								<div class="col-lg-4 col-md-6 mb-3">
									<label for="logistic_telephone">{{ __('messages.telephone') }} <span class="text-danger">*</span></label>
									<input type="tel" class="form-control" id="logistic_telephone" name="logistic_telephone" required="">
									<small class="form-text text-muted text-color">{{ __('messages.telephone_noti') }}</small>
								</div>
							</div>
							<hr>
							
							<div class="form-row">
								<div class="col-12 mb-3">
									<label class="align-top">{{ __('messages.receive_infomation') }} :</label>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" id="receive_info1" name="receive_info" value="1" checked>
										<label class="form-check-label" for="receive_info1">{{ __('messages.receive_yes') }}</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" id="receive_info2" name="receive_info" value="0">
										<label class="form-check-label" for="receive_info2">{{ __('messages.receive_no') }}</label>
									</div>
								</div>
							</div>
							<div style="background: #393536;color: #fff;" class="px-4 py-2 mb-4">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="privacy_confirm" name="privacy_confirm" required="">
									<label class="form-check-label" for="privacy_confirm">{{ __('messages.privacy_confirm') }}<a href="javascript:;" class="text-color pl-2"><b><u>Privacy Policy</u></b></a></label>
								</div>
							</div>
						</div>
						<div class="row px-3 py-4" style="background-color: #ffffff;">
							<div class="col-xl-4 offset-xl-4 col-lg-5 offset-lg-3 col-md-6 px-1 mb-3">
								<div class="g-recaptcha" data-sitekey="6Ldbdg0TAAAAAI7KAf72Q6uagbWzWecTeBWmrCpJ"></div>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-3 col-6 px-1">
								<button type="reset" class="btn btn-secondary border-0 w-100">{{ __('messages.reset') }}</button>
							</div>
							<div class=" col-xl-2 col-lg-2 col-md-3 col-6 px-1">
								<button type="submit" class="btn border-0 w-100">{{ __('messages.submit') }}</button>
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
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script>
  $(document).ready(function() {
    
    $("#check_current_address").click(function() {
        if($('#check_current_address').is(':checked')) {
        $("#logistic_address").val($("#address").val());
        $("#logistic_sub_district").val($("#sub_district").val());
        $("#logistic_district").val($("#district").val());
        $("#logistic_province").val($("#province").val());
        $("#logistic_postcode").val($("#postcode").val());
          $('#boxAddress2 .readonly').attr('readonly', true);
        } else {
          $('#boxAddress2 .readonly').attr('readonly', false);
        }
    });
    
      $("#address").on("input", function() {
        if($('#check_current_address').is(':checked')) {
          $("#logistic_address").val(this.value);
        }
    });
      $("#sub_district").on("input", function() {
        if($('#check_current_address').is(':checked')) {
          $("#logistic_sub_district").val(this.value);
        }
    });
      $("#district").on("input", function() {
        if($('#check_current_address').is(':checked')) {
          $("#logistic_district").val(this.value);
        }
    });
      $("#province").on("input", function() {
        if($('#check_current_address').is(':checked')) {
          $("#logistic_province").val(this.value);
        }
    });
      $("#postcode").on("input", function() {
        if($('#check_current_address').is(':checked')) {
          $("#logistic_postcode").val(this.value);
        }
    });
    
  });
  </script>
@endpush
