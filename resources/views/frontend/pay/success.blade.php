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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.your_order') }}
                        {{ __('messages.is_successfully_saved') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="mt-2 mb-5">
        <div class="container">
            <div class="box-paper border-top">
                <div class="box-head">
                    <img src="{{ asset('images/I-Checkmark1.svg') }}">
                    <h5>{{ __('messages.your_order') }} {{ $orderResult['code'] }}
                        {{ __('messages.is_successfully_saved') }}</h5>
                </div>
                <div class="box-body">
                    <h5 class="text-color">{{ __('messages.cart_total_payment') }} :
                        ฿{{ number_format($orderResult['total_amount'], 2) }}</h5>
                    <p>{{ __('messages.order_message_1') }}</p>
                </div>

                <div class="row px-3 py-5">
                    @foreach ($bank_accounts as $bank_account)
                    <div class="col-lg-4 col-md-12 b-list">
                        <div class="box-bank">
                            <img src="{{ asset('images/icon-footer/icon-bank1.jpg') }}" class="img-bank" alt="">
                            <h6>{{ $bank_account->{get_lang('bank_name')} }}</h6>
                            {{ __('messages.bank_acc_name') }} {{ $bank_account->acc_name }}
                            <h5>{{ __('messages.bank_acc_no') }} {{ $bank_account->acc_no }}</h5>
                        </div>
                        <a href="http://{{ $bank_account->linkurl }}" target="_blank">
                            @if ($bank_account->qrcode)
                            <img src="{{ $bank_account->qrcode }}" class="img-QRCode" alt="">
                            @else
                            http://{{ $bank_account->linkurl }}
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>

                <div class="box-body">
                    <p>{{ __('messages.order_message_2') }}</p>
                </div>
                <div class="row pb-5 mx-auto" style="max-width: 500px;">
                    <div class="col-6 px-1">
                        <a href="{{ route('frontend.home', ['locale' => get_lang()]) }}"
                            class="btn btn-secondary border-0 w-100">{{ __('messages.btn_back_to_main_page') }}</a>
                    </div>
                    <div class="col-6 px-1">
                        <a href="{{ route('frontend.payment', ['locale' => get_lang(), 'orderCode' => $orderResult['code']]) }}"
                            class="btn border-0 w-100">{{ __('messages.payment_title') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
    $(function() {
        sumTotal(1);
        if (!$('#button-hourglass').hasClass('active')) $('#button-hourglass').addClass('active');
    });
</script>
@endpush
