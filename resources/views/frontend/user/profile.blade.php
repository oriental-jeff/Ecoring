@extends('frontend.layouts.main')

@push('after-css')
{{-- <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" /> --}}
{{-- <link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" /> --}}
<style>
  .remove-icon {
    cursor: pointer;
  }
</style>
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
              href="{{ route('frontend.home', ['locale' => get_lang()]) }}">{{ __('messages.home') }}</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('messages.profile') }}</li>
        </ol>
      </nav>
    </div>
  </section>

  <section class="mt-2 mb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="b-sticky text-center">
            <div class="img rounded-circle border border-light mx-auto mb-3" id="preview-avatar"
              style="max-width: 200px;">
              <img src="{{ $user->profiles->avatar ?? asset('images/img-profile.jpg') }}">
            </div>
            <h4>{{ $user->name }}</h4>
            <p>
              {{ $user->profiles->provinces->{ get_lang('name') } }}<br>
              <br>
              {{ __('messages.telephone') }} : {{ $user->profiles->telephone }}<br>
              {{ __('messages.email') }} : {{ $user->email }}<br>
            </p>
            <hr>
            <div class="row">
              <div class="col-6 pr-0">
                <form action="{{ route('frontend.user.update', ['locale' => get_lang(), 'user' => $user->id]) }}"
                  method="POST" enctype="multipart/form-data" id="form-avatar">
                  @method('patch')
                  @csrf
                  <button type="button" class="btn font-weight-light radius-25 w-100" onclick="browseAvatar()">
                    <img style="width: 23px;" src="{{ asset('images/icon-camera.svg') }}">
                    {{ __('messages.profile_image') }}
                  </button>
                  <input type="file" name="avatar" id="avatar" style="display: none;">
                </form>
              </div>

              <div class="col-6 pl-1">
                <a class="btn font-weight-light radius-25 w-100" id="btnEdit" href="javascript:;">
                  <img style="width: 23px;" src="{{ asset('images/icon-edit.svg') }}">
                  {{ __('messages.edit_profile') }}
                </a>
              </div>
            </div>
            <hr>
            <a class="btn btn-secondary font-weight-light radius-25 w-100 mb-3"
              href="{{ route('frontend.user.history', ['locale' => get_lang()]) }}">
              <img class="m-0 mr-2" style="width: 23px;" src="{{ asset('images/icon-history.svg') }}">
              {{ __('messages.history') }}
            </a>
            <a class="btn btn-secondary font-weight-light radius-25 w-100 mb-3"
              href="{{ route('frontend.user.favorite', ['locale' => get_lang(), 'user' => $user->id]) }}">
              <i class="fa fa-heart-o pr-2"></i>
              {{ __('messages.favorite') }}
            </a>
            <hr>
            <a class="btn btn-danger font-weight-light radius-25 w-100 mb-3" href="javascript:;"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <img class="m-0 mr-2" style="width: 23px;" src="{{ asset('images/icon-logout.svg') }}">
              {{ __('messages.logout') }}
            </a>
          </div>
        </div>

        {{-- Start : Section Form --}}
        <div class="col-lg-9">
          {{-- Alert Messages --}}
          @if(Session::has('message'))
          <div id="alert_box" class="alert {{ Session::get('alert-class', 'alert-light') }} py-2">
            <b>{{ Session::get('message') }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          {{-- Alert Validate Errors --}}
          @if ($errors->any())
          @foreach ($errors->all() as $error)
          <div id="alert_box" class="alert alert-danger py-2">
            <b>{{ $error }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endforeach
          @endif

          <div class="box-paper border-top">
            @method('patch')
            @csrf
            <div class="box-head text-left pb-2">
              <h5 style="color: #00b16b;">{{ __('messages.data_account') }}</h5>
              <div class="form-row align-items-end">
                <div class="col-xl-9 col-lg-8 mb-3">
                  <label style="color: #212529;">{{ __('messages.username') }}</label>
                  <input type="text" class="form-control" placeholder="{{ __('messages.username_placeholder') }}"
                    value="{{ $user->email }}" readonly="">
                </div>
                <div class="col-xl-3 col-lg-4 mb-3">
                  <a class="float-right btn font-weight-light radius-25"
                    href="{{ route('frontend.user.edit-password', ['locale' => get_lang(), 'user' => $user->id]) }}">
                    <img class="m-0 float-left mr-2" style="width: 23px;"
                      src="{{ asset('images/icon-Password2.svg') }}">
                    {{ __('messages.edit_password') }}
                  </a>
                </div>
              </div>
              <hr>
              <div class="pt-2 pb-3 m-auto row" style="max-width: 600px;">
                <div class="col-sm-6 p-1">
                  @php
                  $fb = $user->social_account->first(function($item) {
                  return $item->provider == 'facebook';
                  });
                  @endphp
                  @if ($user->social_account && $fb)
                  <a href="{{ route('frontend.deauth.provider', ['locale' => get_lang(), 'provider' => 'facebook']) }}"
                    class="btn-face"><img src="{{ asset('images/btn-face.jpg') }}">
                    {{ __('messages.unbind_account_with') }}
                    Facebook</a>
                  @else
                  <a href="{{ route('frontend.auth.provider', ['locale' => get_lang(), 'provider' => 'facebook']) }}"
                    class="btn-face"><img src="{{ asset('images/btn-face.jpg') }}">
                    {{ __('messages.bind_account_with') }}
                    Facebook</a>
                  @endif
                </div>
                <div class="col-sm-6 p-1">
                  @php
                  $ln = $user->social_account->first(function($item) {
                  return $item->provider == 'line';
                  });
                  @endphp
                  @if ($user->social_account && $ln)
                  <a href="{{ route('frontend.deauth.provider', ['locale' => get_lang(), 'provider' => 'line']) }}"
                    class="btn-line"><img src="{{ asset('images/btn-line.jpg') }}">
                    {{ __('messages.unbind_account_with') }}
                    Line</a>
                  @else
                  <a href="{{ route('frontend.auth.provider', ['locale' => get_lang(), 'provider' => 'line']) }}"
                    class="btn-line"><img src="{{ asset('images/btn-line.jpg') }}">
                    {{ __('messages.bind_account_with') }}
                    Line</a>
                  @endif
                </div>
              </div>
            </div>

            <form class="form-horizontal" method="post" id="form-validate" name="demo-form" accept-charset="utf-8"
              action="{{ route('frontend.user.update', ['locale' => get_lang(), 'user' => $user->id]) }}">
              @method('patch')
              @csrf
              <div class="box-body text-left" style="max-width:none;">
                <h5 style="color: #00b16b;">{{ __('messages.data_profile') }}</h5>
                <div class="form-row">
                  <div class="col-lg-6 col-md-6 mb-3">
                    <label for="first_name">{{ __('messages.name') }}</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                      value="{{ $user->first_name }}" required="" readonly>
                  </div>

                  <div class="col-lg-6 col-md-6 mb-3">
                    <label for="last_name">{{ __('messages.surname') }}</label>
                    <input type="tel" class="form-control" id="last_name" name="last_name"
                      value="{{ $user->last_name }}" required="" readonly>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-lg-6 col-md-6 mb-3">
                    <label class="w-100">{{ __('messages.sex') }}</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="sex1" name="sex" value="1"
                        {{ $user->profiles->sex == 1 ? 'checked' : '' }} disabled>
                      <label class="form-check-label" for="sex1">{{ __('messages.men') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="sex2" name="sex" value="2"
                        {{ $user->profiles->sex == 2 ? 'checked' : '' }} disabled>
                      <label class="form-check-label" for="sex2">{{ __('messages.women') }}</label>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 mb-3">
                    <label for="birthday">{{ __('messages.birthday') }}</label>
                    <input type="date" class="form-control" id="birthday" name="birthday"
                      value="{{ $user->profiles->birthday }}" required="" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-6 col-md-6 mb-3">
                    <label for="telephone">{{ __('messages.telephone') }}</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone"
                      value="{{ $user->profiles->telephone }}" required="" readonly>
                  </div>
                  <div class="col-lg-6 col-md-6 mb-3">
                    <label for="email2">{{ __('messages.email') }}</label>
                    <input type="email" class="form-control" id="email2" value="{{ $user->email }}" disabled>
                  </div>
                </div>
                <hr>

                <h5 style="color: #00b16b;">{{ __('messages.data_address') }}</h5>
                <div class="form-row">
                  <div class="col-lg-6 col-md-6 mb-3">
                    <label for="address">{{ __('messages.address') }}</label>
                    <input type="text" class="form-control" id="address" name="address"
                      value="{{ $user->profiles->address }}" required="" readonly>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-3">
                    <label for="province">{{ __('messages.province') }}</label>
                    <select class="form-control area-select" id="province" name="province" data-size="10"
                      data-live-search="true" required="" readonly>
                      <option value="">{{ __('messages.please_select') }}</option>
                      @foreach($provinces as $province)
                      <option value="{{ $province->id }}"
                        {{ $user->profiles->province_id == $province->id ? 'selected' : '' }}>
                        {{ $province->{ get_lang('name') } }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-3">
                    <label for="district">{{ __('messages.district') }}</label>
                    <select class="form-control" id="district" name="district" required="" readonly>
                      <option value="">{{ __('messages.please_select') }}</option>
                      @foreach($districts as $district)
                      <option value="{{ $district->id }}"
                        {{ $user->profiles->district_id == $district->id ? 'selected' : '' }}>
                        {{ $district->{ get_lang('name') } }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-3">
                    <label for="sub_district">{{ __('messages.sub_district') }}</label>
                    <select class="form-control" id="sub_district" name="sub_district" required="" readonly>
                      <option value="">{{ __('messages.please_select') }}</option>
                      @foreach($sub_districts as $sub_district)
                      <option value="{{ $sub_district->id }}"
                        {{ $user->profiles->sub_district_id == $sub_district->id ? 'selected' : '' }}>
                        {{ $sub_district->{ get_lang('name') } }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-3">
                    <label for="postcode">{{ __('messages.postcode') }}</label>
                    <input type="tel" class="form-control" id="postcode" name="postcode"
                      value="{{ $user->profiles->postcode }}" required="" readonly>
                  </div>
                </div>
                <br>

                {{-- Start : Delivery Addresses --}}
                <h5 style="color: #00b16b;">{{ __('messages.data_address_delivery') }}</h5>
                <div id="box-deli-address">
                  @foreach ($user->address_deliveries as $key => $deli_address)
                  <div class="form-row content-deli-address" id="content-deli-address-1">
                    <div class="col-12">
                      <label class="mr-3" id="count-deli-address">
                        {{ __('messages.address') }} {{ $key + 1 }}
                      </label>

                      <i class="fa fa-lg fa-times-circle text-danger remove-icon d-none"
                        onclick="decreaseDeliveryAddress(this)"></i>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-3">
                      <label for="delivery_fullname">{{ __('messages.name') }}</label>
                      <input type="text" class="form-control" id="delivery_fullname" name="delivery_fullname[]"
                        value="{{ $deli_address->fullname }}" required readonly>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-3">
                      <label for="delivery_telephone">{{ __('messages.telephone') }}</label>
                      <input type="tel" class="form-control" id="delivery_telephone" name="delivery_telephone[]"
                        value="{{ $deli_address->telephone }}" required="" readonly>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-3">
                      <label for="delivery_address">{{ __('messages.address') }}</label>
                      <input type="text" class="form-control" id="delivery_address" name="delivery_address[]"
                        value="{{ $deli_address->address }}" required="" readonly>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-3">
                      <label for="delivery_province">{{ __('messages.province') }}</label>
                      <select class="form-control area-select deli-province" id="delivery_province_1"
                        name="delivery_province[]" data-size="10" data-live-search="true"
                        onchange="changeLogisticProvince(this)" required readonly>
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->id }}"
                          {{ $deli_address->province_id == $province->id ? 'selected' : '' }}>
                          {{ $province->{ get_lang('name') } }}
                        </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-3">
                      <label for="delivery_district">{{ __('messages.district') }}</label>
                      <select class="form-control deli-district" id="delivery_district_1" name="delivery_district[]"
                        onchange="changeLogisticDistrict(this)" required readonly>
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($districts as $district)
                        <option value="{{ $district->id }}"
                          {{ $deli_address->district_id == $district->id ? 'selected' : '' }}>
                          {{ $district->{ get_lang('name') } }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label for="delivery_sub_district">{{ __('messages.sub_district') }}</label>
                      <select class="form-control deli-subdistrict" id="delivery_sub_district_1"
                        name="delivery_sub_district[]" required readonly>
                        <option value="">{{ __('messages.please_select') }}</option>

                        @foreach($sub_districts as $sub_district)
                        <option value="{{ $sub_district->id }}"
                          {{ $deli_address->sub_district_id == $sub_district->id ? 'selected' : '' }}>
                          {{ $sub_district->{ get_lang('name') } }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label for="delivery_postcode">{{ __('messages.postcode') }}</label>
                      <input type="tel" class="form-control" id="delivery_postcode" name="delivery_postcode[]"
                        value="{{ $deli_address->postcode }}" required="" readonly>
                    </div>

                    <input type="hidden" id="deli-address-id" name="deli_address_id[]" value="{{ $deli_address->id }}">
                  </div>
                  <hr>
                  @endforeach
                </div>
                {{-- End : Delivery Addresses --}}

                {{-- Receive Infomation --}}
                <div class="form-row">
                  <div class="col-12 mb-3">
                    <label class="align-top">{{ __('messages.receive_infomation') }} :</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="receive_info1" name="receive_info" value="1"
                        {{ $user->profiles->receive_info == 1 ? 'checked' : '' }} disabled>
                      <label class="form-check-label" for="receive_info1">{{ __('messages.receive_yes') }}</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="receive_info2" name="receive_info" value="0"
                        {{ $user->profiles->receive_info == 0 ? 'checked' : '' }} disabled>
                      <label class="form-check-label" for="receive_info2">{{ __('messages.receive_no') }}</label>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Buttons Control Form --}}
              <div class="row px-3 py-4" style="background-color: #ffffff; display: none;" id="boxBtn">
                <div class="col-xl-3 col-lg-3 col-md-3 col-4 px-1">
                  <button type="button" class="btn border-0 w-100"
                    onclick="increaseDeliveryAddress()">
                    {{ __('messages.btn_more_delivery_address') }}
                </button>
                </div>

                <div class="col-xl-2 col-lg-2 offset-lg-5 col-md-3 offset-md-3 col-4 px-1">
                  <button type="button" class="btn btn-secondary border-0 w-100"
                    onclick="window.location.reload(true);">{{ __('messages.reset') }}</button>
                </div>

                <div class=" col-xl-2 col-lg-2 col-md-3 col-4 px-1">
                  <button type="submit" class="btn border-0 w-100">{{ __('messages.submit') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        {{-- End : Section Form --}}
      </div>
    </div>
  </section>
</div>
<!-- end #content -->

@endsection

@push('after-scripts')
<script>
  function increaseDeliveryAddress() {
        let content = $('div[id^="content-deli-address-"]:last');
		let count = $('.content-deli-address').length + 1;
        let clone = content.clone(false).attr('id', 'content-deli-address-' + count);
        let word_address = "{{ __('messages.address') }}";

		clone.find('#count-deli-address').text(word_address + ' ' + count);
		clone.find('.remove-icon').removeClass('d-none');
        clone.find('input').val('');
        clone.find('.deli-province').val('').attr({id: 'delivery_province_' + count, name: 'new_delivery_province[]'});
        clone.find('.deli-district').empty().attr({id: 'delivery_district_' + count, name: 'new_delivery_district[]'});
        clone.find('.deli-subdistrict').empty().attr({id: 'delivery_sub_district_' + count, name: 'new_delivery_sub_district[]'});
        clone.find('#delivery_fullname').attr('name', 'new_delivery_fullname[]');
        clone.find('#delivery_telephone').attr('name', 'new_delivery_telephone[]');
        clone.find('#delivery_address').attr('name', 'new_delivery_address[]');
        clone.find('#delivery_postcode').attr('name', 'new_delivery_postcode[]');
        // clone.find('#deli-address-id').remove();
		$('#box-deli-address').append(clone);
        $('<hr>').insertAfter('#content-deli-address-' + count);
    }

    function decreaseDeliveryAddress(obj) {
        $(obj).parents().eq(1).next().remove();
        $(obj).parents().eq(1).remove();
    }

    function browseAvatar() {
        $('#avatar').click();
    }

    $(document).ready(function() {
        // Preview Avatar
        $('#avatar').on('change', function(){
            let id = $(this).attr('id');
            readURL(this, "preview-avatar");
            $('#form-avatar').submit();
        });

    $(document).on("click","#btnEdit",function() {
        $(this).addClass('active');
        $('#form-validate [readonly]').attr('readonly', false);
        $('#form-validate [disabled]').attr('disabled', false);
        $('#boxBtn').slideDown();
        $('#first_name').focus()[0].setSelectionRange(99999, 99999);
        $('.remove-icon').removeClass('d-none');
        $('.remove-icon:first').addClass('d-none');

        $('html').animate({scrollTop:$('#form-validate').offset().top-90}, '500');
        $('#form-validate #email2').attr('readonly', true);
   });

    $("#province").on("change", function() {
      changeProvince();
    });

    $("#district").on("change", function() {
      changeDistrict();
    });

    $("#sub_district").on("change", function() {
      // $('#postcode').val($('#sub_district').attr('data-zipcode'));
    });

    $("#delivery_sub_district").on("change", function() {
      $('#delivery_postcode').val($('#delivery_sub_district').attr('data-zipcode'));
    });

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

//   Delivery Address
  function changeLogisticProvince(obj) {
    let count = $(obj).attr('id').split('_')[2];
    var province = $(obj).val();
    var opt = "<option value=\"\" selected=\"selected\">{{ __('messages.please_select') }}</option>";
    $('#delivery_district').attr('readonly', false).html(opt);
    $('#delivery_sub_district_' + count).html(opt);
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
          $('#delivery_district_' + count).html(opt);
        }
      });
    }
  }

  function changeLogisticDistrict(obj) {
    let count = $(obj).attr('id').split('_')[2];
    var district = $(obj).val();
    var opt = "<option value=\"\" selected=\"selected\">{{ __('messages.please_select') }}</option>";
    $('#delivery_sub_district_' + count).attr('readonly', false).html(opt);
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
          $('#delivery_sub_district_' + count).html(opt);
        }
      });
    }
  }
</script>
@endpush
