@extends('frontend.layouts.main')
@push('after-css')
<link href="{{ asset('css/frontend/cart.css?v') . time() }}" rel="stylesheet" />
<link href="{{ asset('css/frontend/cart-control.css?v') . time() }}" rel="stylesheet" />
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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.cart_title') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="box-history">
        <form class="form-horizontal" method="post" id="order-form-validate" name="demo-form"
            enctype="multipart/form-data" action="{{ route('frontend.cart-order', ['locale' => get_lang()]) }}">
            @method('post')
            <div class="container">
                <h4>{{ __('messages.cart_title') }}</h4>

                <div class="box-order font-weight-normal">
                    <div class="order-head row">
                        <div class="col-xl-4 col-sm-5 d-none d-md-block">
                            <input type="checkbox" name="selectAllPDT" class="selectAll">
                            {{ __('messages.cart_detail') }}
                        </div>
                        <div class="col-xl-2 col-sm-1 d-none d-md-block text-center">
                            {{ __('messages.cart_quantity') }}
                        </div>
                        <div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
                            {{ __('messages.cart_unit') }}
                        </div>
                        <div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
                            {{ __('messages.cart_amount') }}
                        </div>
                        <div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
                            {{ __('messages.cart_action') }}
                        </div>
                    </div>

                    @foreach ($carts as $cart)
                    <div class="order-body row position-relative">
                        @if ($cart->stocks[0]->quantity === 0 or GlobalFn::productReservedOnCart($cart->product->id))
                        <div class="order-disabled"></div>
                        @endif
                        <div class="col-md-6 col-ms-5 d-flex align-items-center">
                            <input type="checkbox" name="cartID[]" value="{{ $cart->id }}"
                                {{ ($cart->stocks[0]->quantity === 0 or GlobalFn::productReservedOnCart($cart->product->id)) ? 'disabled' : '' }}>
                            <div class="img">
                                <div class="src-img"
                                    style="background-image: url('{{ $cart->product->image ?? 'http://via.placeholder.com/500x350' }}')">
                                    <img src="{{ url('images/size-img2.png') }}" alt="">
                                    <!-- ช่องนี้ห้ามแก้ -->
                                </div>
                            </div>
                            <div class="flex">
                                <a
                                    href="{{ route('frontend.product-detail', ['locale' => get_lang(), 'product' => $cart->product->id]) }}">
                                    <div class="pdtTitle">{{ $cart->product->{ get_lang('name') } }}</div>
                                    @if (GlobalFn::getCountProductOnCart($cart->product->id) > 0)
                                    <small class="count-product-on-cart">
                                        {{ GlobalFn::getCountProductOnCart($cart->product->id)}}
                                        {{ __('messages.count_product_on_cart') }}</small>
                                    @endif
                                </a>
                            </div>
                            <div class="Bnumber ml-auto">
                                <div class="d-block d-md-none float-left">{{ __('messages.cart_unit') }}</div>
                                <span>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-delete disabled">-</button>
                                        <input type="text" name="quantity[]" class="btn quantity"
                                            value="{{ $cart->quantity }}" onchange="calAmount($(this));"
                                            {{ ($cart->stocks[0]->quantity === 0 or GlobalFn::productReservedOnCart($cart->product->id)) ? 'disabled' : '' }}>
                                        <button type="button" class="btn btn-plus">+</button>
                                    </div>
                                    <div class="text-center">
                                        @if ($cart->stocks[0]->quantity == 0)
                                        <div class="text-danger">{{ __('messages.out_of_stock') }}</div>
                                        @elseif ($cart->quantity > $cart->stocks[0]->quantity)
                                        <div class="text-danger">
                                            {{ __('messages.not_enought_product') }}
                                        </div>
                                        @endif
                                        <div>( {{ __('messages.cart_stock') }}
                                            {{ GlobalFn::productReservedOnCart($cart->product->id) ? 0 : $cart->stocks[0]->quantity }}
                                            )
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-ms-2 col-6 text-center display-price">
                            <b class="line-through">฿{{ number_format($cart->product->full_price) }}</b><br>
                            ฿<span>{{ number_format($cart->product->product_price) }}</span>
                        </div>
                        <div class="col-md-2 col-ms-2 col-6 text-center display-amount">
                            @if ($cart->stocks[0]->quantity === 0 or
                            GlobalFn::productReservedOnCart($cart->product->id))
                            ฿<span>{{ number_format($cart->product->product_price * 0) }}</span>
                            @else
                            ฿<span>{{ number_format($cart->product->product_price * $cart->quantity) }}</span>
                            @endif
                        </div>
                        <div class="col-md-2 col-ms-2 text-center border-left"
                            style="{{ ($cart->stocks[0]->quantity === 0 or GlobalFn::productReservedOnCart($cart->product->id)) ? 'z-index:1' : '' }}">
                            {{-- @if ($cart->stocks[0]->quantity != 0) --}}
                            <a data-id="{{ $cart->id }}" aria-placeholder="{{ __('messages.cart_delete_confirm') }}"
                                class="btn-remmove-cart btn btn-secondary font-weight-light radius-25 w-100"
                                href="javascript:void(0);">
                                <img class="m-0 mr-2" style="width: 17px;" src="{{ url('images/icon-delete.svg') }}">
                                {{ __('messages.cart_delete') }}
                            </a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="row font-weight-normal mb-4">
                    <div class="offset-lg-8 col-lg-2 offset-md-6 col-md-3 offset-2 col-5 text-center">
                        <h5>{{ __('messages.cart_total') }}</h5>
                    </div>
                    <div class="col-lg-2 col-md-3 col-5 text-center display-total">
                        <h5>฿<span>0</span></h5>
                    </div>
                </div>

                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                        <a href="{{ route('frontend.product', ['locale' => get_lang()]) }}"
                            class="btn btn-secondary border-0 w-100">{{ __('messages.btn_continue_shipping') }}</a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1"><a href="javascript:void(0);"
                            onclick="$('#order-form-validate').submit();" class="btn border-0 w-100 btn-next-process"
                            disabled>{{ __('messages.btn_continue') }}</a>
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
        sumTotal();
        $(".selectAll").on('click', function () {
            $('input:checkbox').not(this).not(':disabled').prop({checked: this.checked});
        });
        $('input:checkbox').on('change', function() {
            sumTotal();
        });
    });
</script>
@endpush
