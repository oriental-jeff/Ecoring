@extends('frontend.layouts.main')
@push('after-css')
<link href="{{ asset('css/frontend/cart.css?v') . time() }}" rel="stylesheet" />
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
        <div class="container">
            <h4>{{ $pages->{get_lang('title')} }}</h4>

            <div class="box-order font-weight-normal">
                <div class="order-head row">
                    <div class="col-xl-4 col-sm-5 d-none d-md-block">
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
                <div class="order-body row">
                    <div class="col-md-6 col-ms-5 d-flex align-items-center">
                        <div class="img">
                            <div class="src-img"
                                style="background-image: url('{{ $cart->product->image ?? 'http://via.placeholder.com/500x350' }}')">
                                <img src="{{ url('images/size-img2.png') }}" alt="">
                                <!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                        {{ $cart->product->{ get_lang('name') } }}
                        <div class="Bnumber ml-auto">
                            <div class="d-block d-md-none float-left">จำนวน</div>
                            <span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-delete disabled">-</button>
                                    <input type="text" class="btn quantity" value="{{ $cart->stocks[0]->quantity }}"
                                        onchange="calAmount($(this));">
                                    <button type="button" class="btn btn-plus">+</button>
                                    {{-- {{ $cart->stocks[0]->quantity == '1' ? 'disabled' : '' }} --}}
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 col-ms-2 col-6 text-center display-price">
                        <b class="line-through">฿{{ number_format($cart->product->full_price) }}</b><br>
                        ฿<span>{{ number_format($cart->product->price) }}</span>
                    </div>
                    <div class="col-md-2 col-ms-2 col-6 text-center display-amount">
                        ฿<span>{{ number_format($cart->product->price * $cart->quantity) }}</span>
                    </div>
                    <div class="col-md-2 col-ms-2 text-center border-left">
                        <a class="btn btn-secondary font-weight-light radius-25 w-100" href="#">
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
                    <h5>฿<span></span></h5>
                </div>
            </div>

            <div class="row px-2">
                <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                    <a href="#" class="btn btn-secondary border-0 w-100" download="">ซื้อสินค้าเพิ่ม</a>
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-1">
                    <a href="../cart/order.php" class="btn border-0 w-100">ดำเนินการต่อ</a>
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
        sumTotal();
    })
    function calAmount(e) {
        var price = e.closest('.order-body').find('.display-price span').text();
        var unit = e.parent().find('input').val();
        var amount = e.parent().parent().parent().parent().next().next().find('span');
        amount.html(numberWithCommas(parseFloat(unit.replace(',','')) * parseFloat(price.replace(',',''))));
        sumTotal();
    }
    function sumTotal() {
        var total = 0;
        $('.box-history .order-body').each(function() {
            total += parseFloat($(this).find('.display-amount>span').html().replace(',',''));
        });
        $('.display-total span').html(numberWithCommas(total));
    }
</script>
@endpush
