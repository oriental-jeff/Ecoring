@extends('frontend.layouts.main')
@push('after-css')
<link href="{{ asset('css/frontend/pay.css?v') . time() }}" rel="stylesheet" />
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
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.cart', ['locale' => get_lang()]) }}">{{ __('messages.cart_title') }}</a>
                    </li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.pay', ['locale' => get_lang()]) }}">{{ __('messages.order_list_title') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.checkout_title') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="box-history">
        <form class="form-horizontal" method="post" id="pay-form-validate" name="demo-form"
            enctype="multipart/form-data" action="{{ route('frontend.pay-success', ['locale' => get_lang()]) }}">
            @method('post')
            <div class="container">
                <h4>{{ __('messages.checkout_title') }}</h4>
                {{-- <div class="box-status">
                <div class="bTop">
                    <h5 class="text-success">หมายเลขการสั่งซื้อ : UCM789456123</h5>
                    วันที่สั่งสินค้า : 8 ก.พ. 2563 เวลา : 8.00น.
                </div>
            </div> --}}

                <div class="box-order font-weight-normal">
                    <div class="order-head row">
                        <div class="col-md-6 d-none d-md-block">
                            {{ __('messages.cart_detail') }}
                        </div>
                        <div class="col-md-2 d-none d-md-block text-center">
                            {{ __('messages.cart_quantity') }}
                        </div>
                        <div class="col-md-2 d-none d-md-block text-center">
                            {{ __('messages.cart_unit') }}
                        </div>
                        <div class="col-md-2 d-none d-md-block text-center">
                            {{ __('messages.cart_amount') }}
                        </div>
                    </div>
                    @php
                    $totalWeight = 0;
                    @endphp
                    @foreach ($carts as $cart)
                    <div class="order-body row">
                        <input type="hidden" name="cartID[]" value="{{ $cart->id }}">
                        <input type="hidden" name="productPriceFull[]" value="{{ $cart->product->full_price }}">
                        <input type="hidden" name="productPrice[]"
                            value="{{ $cart->product->product_price * $cart->quantity }}">
                        <input type="hidden" class="weight" name="weight[]" value="{{ $cart->product->weight }}">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="img">
                                <div class="src-img"
                                    style="background-image: url('{{ $cart->product->image ?? 'http://via.placeholder.com/500x350' }}')">
                                    <img src="{{ url('images/size-img2.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                                </div>
                            </div>
                            {{ $cart->product->{ get_lang('name') } }}
                            <div class="Bnumber ml-auto">
                                <div class="d-block d-md-none float-left">{{ __('messages.cart_quantity') }}</div>
                                <span class="display-qty">{{ $cart->quantity }}</span>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 text-center display-price">
                            <b
                                class="line-through">฿<span>{{ number_format($cart->product->full_price) }}</span></b><br>
                            ฿<span>{{ number_format($cart->product->product_price) }}</span>
                        </div>
                        <div class="col-md-2 col-6 text-center display-amount">
                            ฿<span>{{ number_format($cart->product->product_price * $cart->quantity) }}</span>
                        </div>
                        @php
                        $totalWeight += $cart->product->weight;
                        @endphp
                    </div>
                    @endforeach
                    @php
                    session()->put('weight', $totalWeight);
                    @endphp
                </div>
                <div class="box-total">
                    <input type="hidden" id="pickup_optional" name="pickup_optional" value="{{ $pickup_optional }}">
                    <div class="row">
                        <div class="col-lg-3 col-sm-5 pt-4 delivery_service">
                            <h5>{{ __('messages.shipping_method') }}</h5>
                            <input type="hidden" name="logistics_id" value="{{ $logistic[0]->id }}">
                            <img src="{{ $logistic[0]->image }}" class="img-Shipment">
                            <h5>{{ $logistic[0]->{get_lang('name')} }}</h5>
                            {{ __('messages.estimated_delivery_time') }} : {{ $logistic[0]->period }}<br>
                            {{ __('messages.shipping_cost') }} : {{ number_format($logistic[0]->logistic_price) }}
                            บาท<br>
                        </div>
                        <div class="col-lg-4 col-sm-7 pt-4 border-left delivery_service">
                            <h5>{{ __('messages.delivery_address') }}</h5>
                            <table class="w-100">
                                <tr>
                                    <td class="w-45">{{ __('messages.name') }} :</td>
                                    <td>{{ $delivery_addr[0]->fullname ?? Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                                        @if ($delivery_addr[0]->fullname)
                                        <input type="hidden" name="fullname"
                                            value="{{ $delivery_addr[0]->fullname ?? Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
                                        @elseif (!$branch[0]->fullname)
                                        <input type="hidden" name="fullname"
                                            value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.telephone') }} :</td>
                                    <td>{{ $delivery_addr[0]->telephone }}
                                        @if ($delivery_addr[0]->telephone)
                                        <input type="hidden" name="telephone"
                                            value="{{ $delivery_addr[0]->telephone }}">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.address') }} :</td>
                                    <td>{{ $delivery_addr[0]->address }}
                                        @if ($delivery_addr[0]->address)
                                        <input type="hidden" name="address" value="{{ $delivery_addr[0]->address }}">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.sub_district') }} :</td>
                                    <td>{{ $delivery_addr[0]->sub_districts->{get_lang('name')} }}
                                        <input type="hidden" name="sub_district_id"
                                            value="{{ $delivery_addr[0]->sub_district_id }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.district') }} :</td>
                                    <td>{{ $delivery_addr[0]->districts->{get_lang('name')} }}
                                        <input type="hidden" name="district_id"
                                            value="{{ $delivery_addr[0]->district_id }}"></td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.province') }} :</td>
                                    <td>{{ $delivery_addr[0]->provinces->{get_lang('name')} }}
                                        <input type="hidden" name="province_id"
                                            value="{{ $delivery_addr[0]->province_id }}"></td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.postcode') }} :</td>
                                    <td>{{ $delivery_addr[0]->postcode }}
                                        <input type="hidden" name="postcode" value="{{ $delivery_addr[0]->postcode }}">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-7 col-sm-12 pt-4 border-left pickup_store">
                            <h5>{{ __('messages.pickup_in_store') }}</h5>
                            <table class="w-100">
                                <tr>
                                    <td class="w-45">{{ __('messages.branch_name') }} :</td>
                                    <td>{{ $branch[0]->fullname ?? Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                                        @if ($branch[0]->fullname)
                                        <input type="hidden" name="fullname"
                                            value="{{ $branch[0]->fullname ?? Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.address') }} :</td>
                                    <td>{{ $branch[0]->{ get_lang('address')} ?? '' }}
                                        @if ($branch[0]->{ get_lang('address')})
                                        <input type="hidden" name="address"
                                            value="{{ $branch[0]->{ get_lang('address')} ?? '' }}">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.contact_number') }} :</td>
                                    <td>{{ $branch[0]->telephone ?? '' }}
                                        @if ($branch[0]->telephone)
                                        <input type="hidden" name="telephone" value="{{ $branch[0]->telephone ?? '' }}">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-5 col-sm-12 pt-4 border-left">
                            <h5><br></h5>
                            <table class="w-100 font-weight-normal" style="line-height: 1.8;">
                                <tr>
                                    <td class="w-45">{{ __('messages.cart_total') }}</td>
                                    <td class="text-right display-total">฿<span>0.00</span>
                                        <input type="hidden" id="total_amount" name="total_amount" value=""></td>
                                </tr>
                                <tr class="text-danger">
                                    <td>{{ __('messages.cart_discount') }}</td>
                                    <td class="text-right display-discount-total">- ฿<span>0.00</span>
                                        <input type="hidden" id="discount" name="discount" value=""></td>
                                </tr>
                                <tr class="d-none">
                                    <td>{{ __('messages.cart_total_weight') }}</td>
                                    <td class="text-right display-weight"><span>0.00</span>
                                        <input type="hidden" id="total_weight" name="total_weight" value=""></td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.cart_shipping') }}</td>
                                    <td class="text-right display-logistic-price">
                                        ฿<span>{{ number_format($pickup_optional == 0 ? $logistic[0]->logistic_price : 0) }}</span>
                                        <input type="hidden" id="delivery_charge" name="delivery_charge"
                                            value="{{ $pickup_optional == 0 ? $logistic[0]->logistic_price : 0 }}"></td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.cart_vat') }} 7%</td>
                                    <td class="text-right display-vat7">฿<span>0.00</span>
                                        <input type="hidden" id="vat" name="vat" value=""></td>
                                </tr>
                            </table>
                            <h3 class="text-right mt-3 text-success display-gtotal">
                                {{ __('messages.cart_total_payment') }} :
                                ฿<span>0.00</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="box-Payment font-weight-normal">
                    <h5>{{ __('messages.payment_option') }}</h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="box-check" type="radio" name="paymentMethod" id="paymentMethod1"
                                value="transfer" checked>
                            <label class="box-check-label" for="paymentMethod1">
                                {{ __('messages.bank_transfer') }}
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <input class="box-check" type="radio" name="paymentMethod" id="paymentMethod2"
                                value="dccard">
                            <label class="box-check-label" for="paymentMethod2">
                                {{ __('messages.credit_debit_card') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                        <button type="button" class="btn btn-secondary border-0 w-100"
                            onclick="window.history.back()">{{ __('messages.btn_back') }}</button>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1">
                        <button type="submit"
                            class="btn-submit btn border-0 w-100">{{ __('messages.btn_place_order') }}</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </section>

</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
    $(function() {
        sumTotal(1);

        // Fixed bug when click back from pay page
        if($('#pickup_optional').val() == 0) {
            $('.delivery_service').show();
            $('.pickup_store').hide();
        } else {
            $('.delivery_service').hide();
            $('.pickup_store').show();
        }
    });
</script>
@endpush
