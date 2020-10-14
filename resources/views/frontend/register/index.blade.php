@extends('frontend.layouts.main')
@push('after-css')
{{-- <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" /> --}}
{{-- <link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" /> --}}
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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.register') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="mt-2 mb-5">
        <div class="container">
            <h4 class="mx-auto mb-4" style="max-width: 1000px;">{{ __('messages.register') }}</h4>
            <div class="box-paper border-top">
                <form class="form-horizontal" method="post" id="form-validate" name="demo-form" accept-charset="utf-8"
                    action="{{ route('frontend.user.store', ['locale' => get_lang()]) }}">
                    @method('post')
                    @csrf
                    <div class="box-head text-left pb-2">
                        <input type="hidden" id="provider" name="provider" value="{{ app('request')->provider ?? '' }}">
                        <input type="hidden" id="provider_user_id" name="provider_user_id"
                            value="{{ app('request')->providerUser['id'] ?? '' }}">
                        <h5 style="color: #00b16b;"><i class="iClause">1</i> {{ __('messages.data_account') }}</h5>
                        <div class="form-row">
                            <div class="col-lg-5 col-md-6 mb-3">
                                <label for="email" style="color: #212529;">{{ __('messages.username') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ __('messages.username_placeholder') }}" required=""
                                    value="{{ app('request')->providerUser['email'] ?? '' }}">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-5 col-md-6 mb-3">
                                <label for="password" style="color: #212529;">{{ __('messages.password') }} <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ __('messages.password_placeholder') }}" required="">
                                <small
                                    class="form-text text-muted text-color">{{ __('messages.password_noti') }}</small>
                            </div>
                            <div class="col-lg-5 col-md-6 mb-3">
                                <label for="confirm_password"
                                    style="color: #212529;">{{ __('messages.confirm_password') }} <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="{{ __('messages.password_placeholder') }}"
                                    required="">
                                <small
                                    class="form-text text-muted text-color">{{ __('messages.confirm_password_noti') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="box-body text-left" style="max-width:none;">
                        <h5 style="color: #00b16b;"><i class="iClause">2</i> {{ __('messages.data_profile') }}</h5>
                        <div class="form-row">
                            <div class="col-lg-5 col-md-6 mb-3">
                                <label for="first_name">{{ __('messages.name') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required=""
                                    value="{{ app('request')->providerUser['name'] ?? '' }}">
                            </div>
                            <div class="col-lg-5 col-md-6 mb-3">
                                <label for="last_name">{{ __('messages.surname') }} <span
                                        class="text-danger">*</span></label>
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
                                <label for="telephone">{{ __('messages.telephone') }} <span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" required="">
                            </div>
                            <div class="col-lg-5 col-md-6 mb-3">
                                <label for="email">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email2"
                                    value="{{ app('request')->providerUser['email'] ?? '' }}" readonly>
                            </div>
                        </div>
                        <hr>

                        <h5 style="color: #00b16b;"><i class="iClause">3</i> {{ __('messages.data_address') }}</h5>
                        <div class="form-row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="address">{{ __('messages.address') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address" required="">
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label for="province">{{ __('messages.province') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control area-select" id="province" name="province" data-size="10"
                                    data-live-search="true" required="">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->{ get_lang('name') } }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label for="district">{{ __('messages.district') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="district" name="district" required="" readonly>
                                    <option value="">{{ __('messages.please_select') }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="sub_district">{{ __('messages.sub_district') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="sub_district" name="sub_district" required="" readonly>
                                    <option value="">{{ __('messages.please_select') }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="postcode">{{ __('messages.postcode') }} <span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="postcode" name="postcode" required="">
                            </div>
                        </div>
                        <br>

                        <h5 style="color: #00b16b;"><i class="iClause">4</i> {{ __('messages.data_address_delivery') }}
                        </h5>
                        <div class="form-row" id="boxAddress2">
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="check_current_address"
                                        name="current_address" checked>
                                    <label class="form-check-label font-weight-light" for="check_current_address">
                                        {{ __('messages.use_same_address') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="delivery_fullname">{{ __('messages.name') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="delivery_fullname" name="delivery_fullname"
                                    required="" value="{{ app('request')->providerUser['name'] ?? '' }}">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="delivery_telephone">{{ __('messages.telephone') }} <span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="delivery_telephone" name="delivery_telephone"
                                    required="">
                                <small
                                    class="form-text text-muted text-color">{{ __('messages.telephone_noti') }}</small>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="delivery_address">{{ __('messages.address') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control readonly" id="delivery_address"
                                    name="delivery_address" required="" readonly>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label for="delivery_province">{{ __('messages.province') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control readonly" id="delivery_province" name="delivery_province"
                                    readonly>
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->{ get_lang('name') } }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label for="delivery_district">{{ __('messages.district') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control readonly readonlyNone" id="delivery_district"
                                    name="delivery_district" readonly>
                                    <option>{{ __('messages.please_select') }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="delivery_sub_district">{{ __('messages.sub_district') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control readonly readonlyNone" id="delivery_sub_district"
                                    name="delivery_sub_district" readonly>
                                    <option>{{ __('messages.please_select') }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="delivery_postcode">{{ __('messages.postcode') }} <span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control readonly" id="delivery_postcode"
                                    name="delivery_postcode" required="" readonly>
                            </div>
                        </div>
                        <hr>

                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label class="align-top">{{ __('messages.receive_infomation') }} :</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="receive_info1" name="receive_info"
                                        value="1" checked>
                                    <label class="form-check-label"
                                        for="receive_info1">{{ __('messages.receive_yes') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="receive_info2" name="receive_info"
                                        value="0">
                                    <label class="form-check-label"
                                        for="receive_info2">{{ __('messages.receive_no') }}</label>
                                </div>
                            </div>
                        </div>
                        <div style="background: #393536;color: #fff;" class="px-4 py-2 mb-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="privacy_confirm"
                                    name="privacy_confirm" required="">
                                <label class="form-check-label"
                                    for="privacy_confirm">{{ __('messages.privacy_confirm') }}
                                    <a href="javascript:;" class="text-color pl-2" data-toggle="modal"
                                        data-target="#privacy_policy"><b><u>Privacy Policy</u></b></a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row px-3 py-4" style="background-color: #ffffff;">
                        {{-- <div class="col-xl-4 offset-xl-4 col-lg-5 offset-lg-3 col-md-6 px-1 mb-3">
								<div class="g-recaptcha" data-sitekey="6Ldbdg0TAAAAAI7KAf72Q6uagbWzWecTeBWmrCpJ"></div>
							</div> --}}
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6 px-1">
                            <button type="reset"
                                class="btn btn-secondary border-0 w-100">{{ __('messages.reset') }}</button>
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
{{-- <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script> --}}
<script>
    $(document).ready(function() {
    // $('.area-select').select2();
    // $('.area-select').selectpicker('render');

    $("#email").on("input", function() {
      $("#email2").val(this.value);
    });

    $("#check_current_address").click(function() {
      if($('#check_current_address').is(':checked')) {
        $("#delivery_fullname").val($("#first_name").val() + ' ' + $("#last_name").val());
        $("#delivery_address").val($("#address").val());
        $("#delivery_sub_district").html($('#sub_district').html()).val($("#sub_district").val());
        $("#delivery_district").html($('#district').html()).val($("#district").val());
        $("#delivery_province").val($("#province").val());
        $("#delivery_postcode").val($("#postcode").val());
        $('#boxAddress2 .readonly').attr('readonly', true);
      } else {
        $('#boxAddress2 .readonly:not(.readonlyNone)').attr('readonly', false);
      }
    });

    $("#first_name, #last_name").on("input", function() {
      if($('#check_current_address').is(':checked')) {
        $("#delivery_fullname").val($("#first_name").val() + ' ' + $("#last_name").val());
      }
    });

    $("#address").on("input", function() {
      if($('#check_current_address').is(':checked')) {
        $("#delivery_address").val(this.value);
      }
    });

    $("#province").on("change", function() {
      if($('#check_current_address').is(':checked')) {
        $("#delivery_province").val(this.value);
      }
      changeProvince();
    });

    $("#district").on("change", function() {
      if($('#check_current_address').is(':checked')) {
        $("#delivery_district").val(this.value).removeClass('readonlyNone');
      }
      changeDistrict();
    });

    $("#sub_district").on("change", function() {
      if($('#check_current_address').is(':checked')) {
        $("#delivery_sub_district").val(this.value).removeClass('readonlyNone');
      }
      $('#postcode').val($('option:selected', this).attr('data-zipcode'));
      if($('#check_current_address').is(':checked')) {
        $('#delivery_postcode').val($('option:selected', this).attr('data-zipcode'));
      }
    });

    $("#postcode").on("input", function() {
      if($('#check_current_address').is(':checked')) {
        $("#delivery_postcode").val(this.value);
      }
    });

    $("#delivery_province").on("change", function() {
      changeLogisticProvince();
    });

    $("#delivery_district").on("change", function() {
      changeLogisticDistrict();
    });

    $("#delivery_sub_district").on("change", function() {
      $('#delivery_postcode').val($('option:selected', this).attr('data-zipcode'));
    });

    $("#form-validate").validate({
      rules : {
        password : {
          minlength : 8
        },
        password_confirmation : {
          minlength : 8,
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

  function changeProvince() {
    var province = $('#province').val();
    var opt = "<option value=\"\" selected=\"selected\">{{ __('messages.please_select') }}</option>";
    $('#district').attr('readonly', false).html(opt);
    if($('#check_current_address').is(':checked')) {
      $('#delivery_district').html(opt);
      $('#delivery_sub_district').html(opt);
    }
    if (province != '') {
      $.ajax({
        type : 'get',
        url : base_url + '/{{ get_lang() }}/get_district_list',
        data : {
          province : province,
          _token : '{{ csrf_token() }}'
        },
        dataType: 'json',
        success:function(data){
          var returnData = data.districts;
          if (returnData.length != 0) {
            for (var i = 0; i < returnData.length; i++) {
              opt += "<option value='" + returnData[i].id + "'>" + returnData[i].name + "</option>";
            }
          }
          $('#district').html(opt);
          if($('#check_current_address').is(':checked')) {
            $('#delivery_district').html(opt);
          }
        }
      });
    }
  }

  function changeDistrict() {
    var district = $('#district').val();
    var opt = "<option value=\"\" selected=\"selected\">{{ __('messages.please_select') }}</option>";
    $('#sub_district').attr('readonly', false).html(opt);
    if($('#check_current_address').is(':checked')) {
      $('#delivery_sub_district').html(opt);
    }
    if (district != '') {
      $.ajax({
        type : 'get',
        url : base_url + '/{{ get_lang() }}/get_sub_district_list',
        data : {
          district : district,
          _token : '{{ csrf_token() }}'
        },
        dataType: 'json',
        success:function(data){
          var returnData = data.sub_districts;
          if (returnData.length != 0) {
            for (var i = 0; i < returnData.length; i++) {
              opt += "<option value='" + returnData[i].id + "' data-zipcode='" + returnData[i].zip_code + "'>" + returnData[i].name + "</option>";
            }
          }
          $('#sub_district').html(opt);
          if($('#check_current_address').is(':checked')) {
            $('#delivery_sub_district').html(opt);
          }
        }
      });
    }
  }

  function changeLogisticProvince() {
    var province = $('#delivery_province').val();
    var opt = "<option value=\"\" selected=\"selected\">{{ __('messages.please_select') }}</option>";
    $('#delivery_district').attr('readonly', false).html(opt);
    $('#delivery_sub_district').html(opt);
    if (province != '') {
      $.ajax({
        type : 'get',
        url : base_url + '/{{ get_lang() }}/get_district_list',
        data : {
          province : province,
          _token : '{{ csrf_token() }}'
        },
        dataType: 'json',
        success:function(data){
          var returnData = data.districts;
          if (returnData.length != 0) {
            for (var i = 0; i < returnData.length; i++) {
              opt += "<option value='" + returnData[i].id + "'>" + returnData[i].name + "</option>";
            }
          }
          $('#delivery_district').html(opt);
        }
      });
    }
  }

  function changeLogisticDistrict() {
    var district = $('#delivery_district').val();
    var opt = "<option value=\"\" selected=\"selected\">{{ __('messages.please_select') }}</option>";
    $('#delivery_sub_district').attr('readonly', false).html(opt);
    if (district != '') {
      $.ajax({
        type : 'get',
        url : base_url + '/{{ get_lang() }}/get_sub_district_list',
        data : {
          district : district,
          _token : '{{ csrf_token() }}'
        },
        dataType: 'json',
        success:function(data){
          var returnData = data.sub_districts;
          if (returnData.length != 0) {
            for (var i = 0; i < returnData.length; i++) {
              opt += "<option value='" + returnData[i].id + "' data-zipcode='" + returnData[i].zip_code + "'>" + returnData[i].name + "</option>";
            }
          }
          $('#delivery_sub_district').html(opt);
        }
      });
    }
  }
</script>
@endpush
