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
                            href="{{ route('frontend.home', ['locale' => get_lang()]) }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ใบสั่งซื้อ</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="box-history">
        <form class="form-horizontal" method="post" id="pay-form-validate" name="demo-form"
            enctype="multipart/form-data" action="{{ route('frontend.pay', ['locale' => get_lang()]) }}">
            @method('post')
            <div class="container">
                <h4>ใบสั่งซื้อ</h4>
                {{-- <div class="box-status">
                <div class="bTop">
                    <h5 class="text-success">หมายเลขการสั่งซื้อ : UCM789456123</h5>
                    วันที่สั่งสินค้า : 8 ก.พ. 2563 เวลา : 8.00น.
                </div>
            </div> --}}

                <div class="box-order font-weight-normal">
                    <div class="order-head row">
                        <div class="col-md-6 d-none d-md-block">
                            รายละเอียดสินค้า
                        </div>
                        <div class="col-md-2 d-none d-md-block text-center">
                            จำนวน
                        </div>
                        <div class="col-md-2 d-none d-md-block text-center">
                            ราคาต่อหน่วย
                        </div>
                        <div class="col-md-2 d-none d-md-block text-center">
                            ราคารวม
                        </div>
                    </div>
                    @foreach ($carts as $cart)
                    <div class="order-body row">
                        <input type="hidden" name="cartID[]" value="{{ $cart->id }}">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="img">
                                <div class="src-img"
                                    style="background-image: url('{{ $cart->product->image ?? 'http://via.placeholder.com/500x350' }}')">
                                    <img src="{{ url('images/size-img2.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                                </div>
                            </div>
                            {{ $cart->product->{ get_lang('name') } }}
                            <div class="Bnumber ml-auto">
                                <div class="d-block d-md-none float-left">จำนวน</div>
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
                    </div>
                    @endforeach
                </div>
                <div class="box-total">
                    <div class="row">
                        <div class="col-lg-3 col-sm-5 pt-4">
                            <h5>ช่องทางการจัดส่ง</h5>
                            <input type="hidden" name="logistic_id" value="{{ $logistic[0]->id }}">
                            <img src="{{ $logistic[0]->image }}" class="img-Shipment">
                            <h5>{{ $logistic[0]->{get_lang('name')} }}</h5>
                            ระยะเวลาการส่ง : {{ $logistic[0]->period }}<br>
                            อัตราค่าบริการ : {{ number_format($logistic[0]->base_price) }} บาท<br>
                        </div>
                        <div class="col-lg-4 col-sm-7 pt-4 border-left">
                            <h5>ที่อยู่ในการจัดส่ง</h5>
                            <table class="w-100">
                                <tr>
                                    <td class="w-45">ชื่อ :</td>
                                    <td>สมหมาย คอมเมิส</td>
                                </tr>
                                <tr>
                                    <td>เบอร์โทร :</td>
                                    <td>0567894567</td>
                                </tr>
                                <tr>
                                    <td>ที่อยู่ :</td>
                                    <td>181/93 ถ.พหลโยธิน 50</td>
                                </tr>
                                <tr>
                                    <td>แขวง/ตำบล :</td>
                                    <td>แขวงอนุสาวรีย์</td>
                                </tr>
                                <tr>
                                    <td>เขต/อำเภอ :</td>
                                    <td>บางเขน</td>
                                </tr>
                                <tr>
                                    <td>จังหวัด :</td>
                                    <td>กรุงเทพฯ</td>
                                </tr>
                                <tr>
                                    <td>รหัสไปรษณีย์ :</td>
                                    <td>10220</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-5 col-sm-12 pt-4 border-left">
                            <h5><br></h5>
                            <table class="w-100 font-weight-normal" style="line-height: 1.8;">
                                <tr>
                                    <td class="w-45">ราคาเต็ม</td>
                                    <td class="text-right display-total">฿<span>0.00</span></td>
                                </tr>
                                <tr class="text-danger">
                                    <td>ส่วนลด</td>
                                    <td class="text-right display-discount-total">- ฿<span>0.00</span></td>
                                </tr>
                                <tr>
                                    <td>ค่าจัดส่ง</td>
                                    <td class="text-right display-logistic-price">
                                        ฿<span>{{ number_format($logistic[0]->base_price) }}</span></td>
                                </tr>
                                <tr>
                                    <td>ภาษี 7%</td>
                                    <td class="text-right display-vat7">฿<span>0.00</span></td>
                                </tr>
                            </table>
                            <h3 class="text-right mt-3 text-success display-gtotal">ยอดรวมทั้งสิ้น : ฿<span>0.00</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="box-Payment font-weight-normal">
                    <h5>เลือกช่องทางการชำระเงิน</h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="box-check" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1" checked>
                            <label class="box-check-label" for="exampleRadios1">
                                โอนเข้าบัญชีธนาคาร
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <input class="box-check" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2">
                            <label class="box-check-label" for="exampleRadios2">
                                ชำระผ่านบัตรเครดิต/เดบิต
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                        <button type="button" class="btn btn-secondary border-0 w-100"
                            onclick="window.history.back()">ย้อนกลับ</button>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1">
                        <a href="../pay/success.php" class="btn border-0 w-100">ยืนยันการชำระเงิน</a>
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
    });
</script>
@endpush
