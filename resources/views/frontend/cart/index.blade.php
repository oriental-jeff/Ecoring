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
                            href="{{ route('frontend.home', ['locale' => get_lang()]) }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pages->{get_lang('title')} }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="box-history">
        <form class="form-horizontal" method="post" id="order-form-validate" name="demo-form" enctype="multipart/form-data"
            action="{{ route('frontend.cart-order', ['locale' => get_lang()]) }}">
            @method('post')
            <div class="container">
                <h4>{{ $pages->{get_lang('title')} }}</h4>

                <div class="box-order font-weight-normal">
                    <div class="order-head row">
                        <div class="col-xl-4 col-sm-5 d-none d-md-block">
                            <input type="checkbox" name="selectAllPDT" class="selectAll">
                            รายละเอียดสินค้า
                        </div>
                        <div class="col-xl-2 col-sm-1 d-none d-md-block text-center">
                            จำนวน
                        </div>
                        <div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
                            ราคาต่อหน่วย
                        </div>
                        <div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
                            ราคารวม
                        </div>
                        <div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
                            จัดการสินค้า
                        </div>
                    </div>

                    @foreach ($carts as $cart)
                    <div class="order-body row position-relative">
                        @if ($cart->stocks[0]->quantity === 0)
                        <div class="order-disabled"></div>
                        @endif
                        {{-- style="position: relative" --}}
                        {{-- <div class="del-loading" style="position: absolute;
                    width: 100%;
                    height: 100%;
                    background: #fff;
                    opacity: 0.7;
                    z-index: 1; display: none;"></div> --}}
                        <div class="col-md-6 col-ms-5 d-flex align-items-center">
                            <input type="checkbox" name="cartID[]" value="{{ $cart->id }}" {{ ($cart->stocks[0]->quantity === 0) ? 'disabled' : '' }}>
                            <div class="img">
                                <div class="src-img"
                                    style="background-image: url('{{ $cart->product->image ?? 'http://via.placeholder.com/500x350' }}')">
                                    <img src="{{ url('images/size-img2.png') }}" alt="">
                                    <!-- ช่องนี้ห้ามแก้ -->
                                </div>
                            </div>
                            <span class="pdtTitle">{{ $cart->product->{ get_lang('name') } }}</span>
                            <div class="Bnumber ml-auto">
                                <div class="d-block d-md-none float-left">จำนวน</div>
                                <span>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-delete disabled">-</button>
                                        <input type="text" name="quantity[]" class="btn quantity" value="{{ $cart->quantity }}"
                                            onchange="calAmount($(this));" {{ ($cart->stocks[0]->quantity === 0) ? 'disabled' : '' }}>
                                        <button type="button" class="btn btn-plus">+</button>
                                        {{-- {{ $cart->stocks[0]->quantity == '1' ? 'disabled' : '' }} --}}
                                    </div>
                                    <div class="text-center">
                                        @if ($cart->stocks[0]->quantity == 0)
                                        <span class="text-danger">สินค้าหมด</span>
                                        @elseif ($cart->quantity > $cart->stocks[0]->quantity)
                                        <span class="text-danger">จำนวนสินค้าไม่เพียงพอ<br>
                                            ( คงเหลือ {{ $cart->stocks[0]->quantity }} )
                                        </span>
                                        @endif
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-ms-2 col-6 text-center display-price disabled" style="color: #ddd">
                            <b class="line-through">฿{{ number_format($cart->product->full_price) }}</b><br>
                            ฿<span>{{ number_format($cart->product->price) }}</span>
                        </div>
                        <div class="col-md-2 col-ms-2 col-6 text-center display-amount">
                            @if ($cart->stocks[0]->quantity === 0)
                            ฿<span>{{ number_format($cart->product->price * 0) }}</span>
                            @else
                            ฿<span>{{ number_format($cart->product->price * $cart->quantity) }}</span>
                            @endif
                        </div>
                        <div class="col-md-2 col-ms-2 text-center border-left" style="z-index:1">
                            <a class="btn btn-secondary font-weight-light radius-25 w-100" href="javascript:void(0);"
                                onclick="delList(this, {{ $cart->id }})">
                                <img class="m-0 mr-2" style="width: 17px;" src="{{ url('images/icon-delete.svg') }}">
                                ลบรายการนี้
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="row font-weight-normal mb-4">
                    <div class="offset-lg-8 col-lg-2 offset-md-6 col-md-3 offset-2 col-5 text-center">
                        <h5>ราคารวม</h5>
                    </div>
                    <div class="col-lg-2 col-md-3 col-5 text-center display-total">
                        <h5>฿<span>0</span></h5>
                    </div>
                </div>

                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                        <a href="{{ route('frontend.product', ['locale' => get_lang()]) }}"
                            class="btn btn-secondary border-0 w-100">ซื้อสินค้าเพิ่ม</a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1"><a href="javascript:void(0);"
                            onclick="$('#order-form-validate').submit();"
                            class="btn border-0 w-100 btn-next-process" disabled>ดำเนินการต่อ</a>
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

    function delList(e, cartId) {
        $(e).closest('.order-body').find('.del-loading').show();
        swal({
            title: "ลบรายการนี้?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/api/v1/carts/' + cartId,
                    type: 'DELETE',
                    success: function (result) {
                        $(e).closest('.order-body').fadeOut('slow', function () {
                            $(this).remove();
                            sumTotal();
                            // swal("This order has been removed.", {
                            //     icon: "success",
                            //     buttons: false,
                            //     timer: 1500
                            // });
                        });
                    },
                    error: function(data) {
                        swal("ผิดพลาด!! ไม่สามารถลบได้", {
                            icon: "delete",
                        });
                        $(e).closest('.order-body').find('.del-loading').hide();
                    }
                });
            } else {
                $(e).closest('.order-body').find('.del-loading').hide();
            }
        });
    }
</script>
@endpush
