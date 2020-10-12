@extends('frontend.layouts.main')
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $pages->{get_lang('title')} }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="mt-2 mb-5">
        <div class="container">
            <h4>{{ __('messages.payment_title') }}</h4>
            <form class="form-horizontal" method="post" id="form-validate" name="demo-form"
                enctype="multipart/form-data"
                action="{{ route('frontend.payment-success', ['locale' => get_lang()]) }}">
                @method('post')
                <div class="form-row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="orders_code">{{ __('messages.order_code') }}<span class="text-danger"> * </span>
                            :</label>
                        <input type="text" class="form-control" id="orders_code" name="orders_code"
                            placeholder="{{ __('messages.order_code') }}"
                            value="{{ old('orders_code') ?? $_GET['orderCode'] ?? '' }}">
                        {{ $errors->first('orders_code') }}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="fullname">{{ __('messages.name') }}<span class="text-danger"> * </span>
                            :</label>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="{{ Auth::user() ? Auth::user()->first_name. ' ' . Auth::user()->last_name : '' }}"
                            {{ Auth::user() ? 'disabled' : 'required' }}>
                        {{ $errors->first('first_name'). ' ' . $errors->first('last_name') }}
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="contact">{{ __('messages.contact_number') }}<span class="text-danger"> * </span>
                            :</label>
                        <input type="tel" class="form-control" id="contact" name="contact"
                            value="{{ Auth::user() ? Auth::user()->profiles->telephone : '' }}"
                            {{ Auth::user() ? 'disabled' : 'required' }}>
                        {{ $errors->first('contact') }}
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="email">{{ __('messages.email') }}<span class="text-danger"> * </span>
                            :</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user() ? Auth::user()->email : '' }}"
                            {{ Auth::user() ? 'disabled' : 'required' }}>
                        {{ $errors->first('email') }}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-2 col-md-6 mb-3">
                        <label for="payment_date">{{ __('messages.date') }}<span class="text-danger"> * </span>
                            :</label>
                        <input type="date" class="form-control" id="payment_date" name="payment_date"
                            value="{{ date("Y-m-d") }}" required>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3">
                        <label for="payment_time">{{ __('messages.time') }}<span class="text-danger"> * </span>
                            :</label>
                        <input type="time" class="form-control" id="payment_time" name="payment_time"
                            value="{{ date("H:i:s") }}" required>
                    </div>
                </div>
                <div class="form-group box2">
                    <h4>{{ __('messages.transfer_to') }}</h4>
                    <div class="form-row">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="bank_accounts_id">{{ __('messages.bank_account') }}<span class="text-danger"> *
                                </span> :</label>
                            <select class="form-control" id="bank_accounts_id" name="bank_accounts_id">
                                @foreach ($bank_accounts as $bank_account)
                                <option value="{{ $bank_account->id }}">{{ $bank_account->{ get_lang('bank_name')} }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3 align-self-end">
                            <div class="input-group">
                                <div class="input-group-prepend pr-3 align-self-center">
                                    {{ __('messages.bank_account') }}<span class="text-danger"> * </span> : </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image"
                                        maxSizeByte="204800" fileType="image" required style="position: absolute">
                                    <label class="btn border-0 w-100 btn-FormControlFile"
                                        for="image">{{ __('messages.btn_upload') }} <i
                                            class="ml-2 fa fa-upload"></i></label>
                                </div>
                                {{ $errors->first('orders_code') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                        <button type="button" class="btn btn-secondary border-0 w-100"
                            onclick="window.history.back()">{{ __('messages.btn_back') }}</button>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1">
                        <button type="submit" class="btn-submit btn border-0 w-100"
                            disabled>{{ __('messages.btn_payment') }}</button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
    $(function() {
        var orderCode = "{{ $_GET['orderCode'] ?? '' }}";
        $('#image').on('change', function(){
            readURL(this);
        });
        // $('#rs_order').hide();
        $('#orders_code').on('change', function() {
            $('.btn-submit').attr('disabled', true);
            $('#rs_order').hide();
            if ($(this).val()) {
                checkorder($(this).val());
            }
        });
        $('#orders_code').on('keyup', function() {
            $('.btn-submit').attr('disabled', true);
        });
        if (orderCode) checkorder(orderCode);
    });
    function checkorder(v) {
        $.ajax({
            type: 'get',
            url: base_url + '/en/check_order',
            data: {
                ordercode: v,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function (result) {
                if (result.msgcode) {
                    swal(result.msgcode, {
                            icon: "warning",
                        })
                } else {
                    $('.btn-submit').attr('disabled', false);
                }
            },
            error: function(data) {
                // $('#rs_order').show();
            }
        });
    }
</script>
@endpush
