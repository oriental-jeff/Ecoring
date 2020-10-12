@extends('frontend.layouts.main')
@push('after-css')
<link href="{{ asset('css/frontend/history-detail.css?v') . time() }}" rel="stylesheet" />
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
                    <li class="breadcrumb-item active" aria-current="page">ประวัติการสั่งซื้อ</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="box-history">
        <div class="container">
            <h4>สถานะการสั่งสินค้า</h4>
            <div class="box-status">
                <div class="bTop">
                    <h5 class="text-success">หมายเลขการสั่งซื้อ : {{ $order[0]->code }}</h5>
                    {{-- วันที่สั่งสินค้า : 8 ก.พ. 2563 เวลา : 8.00น. --}}
                    วันที่สั่งสินค้า : {{ $order[0]->created_at->format("d/m/Y H:i:s") }}
                </div>
                <div class="blist">
                    <ul class="status" data-status="{{ ($order[0]->status < 3) ? 1 : $order[0]->status-1 }}">
                        <li><img src="{{ asset('images/status1.svg') }}">สั่งซื้อสินค้า</li>
                        <li><img src="{{ asset('images/status2.svg') }}">ชำระเงิน</li>
                        <li><img src="{{ asset('images/status3.svg') }}">กำลังจัดเตรียมสินค้า</li>
                        <li><img src="{{ asset('images/status4.svg') }}">จัดส่งสินค้า</li>
                    </ul>
                </div>
            </div>

            <div class="box-detail">
                <h5 class="text-success">ข้อมูลการสั่งซื้อ</h5>
                <div>หมายเลขการสั่งซิ้อ : <span class="float-right">{{ $order[0]->code }}</span></div>
                <div>วันที่สั่งสินค้า : <span
                        class="float-right">{{ $order[0]->created_at->format("d/m/Y H:i:s") }}</span></div>
                <div>สถานะ : <span class="float-right">
                        <div class="Checkmark status{{ ($order[0]->status >= 3) ? 4 : $order[0]->status+1 }}">
                            {{ ($order[0]->status >= 3) ? $status[3]->{get_lang('name')} : $order[0]->status_config->{get_lang('name')} }}
                        </div>
                    </span></div>
                <div>การชำระเงิน : <span class="float-right">{{ $order[0]->payment_type }}</span>
                </div>
            </div>

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
                @php
                $totalDiscount = 0;
                @endphp
                @foreach ($order[0]->cart as $cart)
                <div class="order-body row">
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="img">
                            <div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
                                <img src="{{ $cart->product->image }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                        {{ $cart->product->{get_lang('name')} }}
                        <div class="Bnumber">
                            <div class="d-block d-md-none float-left">จำนวน</div><span>{{ $cart->quantity }}</span>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 text-center">
                        <b class="line-through">฿{{ number_format($cart->amount_full, 2) }}</b><br>
                        ฿{{ number_format($cart->amount, 2) }}
                        @php
                        $totalDiscount += $cart->amount_full - $cart->amount;
                        @endphp
                    </div>
                    <div class="col-md-2 col-6 text-center">
                        ฿{{ number_format($cart->amount * $cart->quantity, 2) }}
                    </div>
                </div>
                @endforeach

            </div>
            <div class="box-total">
                <div class="row">
                    <div class="col-lg-3 col-sm-5 pt-4">
                        <h5>ช่องทางการจัดส่ง</h5>
                        <img src="{{ $order[0]->logistic->image }}" class="img-Shipment">
                        <h5>{{ $order[0]->logistic->{get_lang('name')} }}</h5>
                        ระยะเวลาการส่ง : {{ $order[0]->logistic->period }}<br>
                        อัตราค่าบริการ : {{ number_format($order[0]->delivery_charge) }} บาท<br>
                    </div>
                    <div class="col-lg-4 col-sm-7 pt-4 border-left">
                        <h5>ที่อยู่ในการจัดส่ง</h5>
                        <table class="w-100">
                            <tr>
                                <td class="w-45">ชื่อ :</td>
                                <td>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร :</td>
                                <td>{{ $order[0]->telephone }}</td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td>{{ $order[0]->address }}</td>
                            </tr>
                            <tr>
                                <td>แขวง/ตำบล :</td>
                                <td>{{ $order[0]->sub_districts->{get_lang('name')} }}</td>
                            </tr>
                            <tr>
                                <td>เขต/อำเภอ :</td>
                                <td>{{ $order[0]->districts->{get_lang('name')} }}</td>
                            </tr>
                            <tr>
                                <td>จังหวัด :</td>
                                <td>{{ $order[0]->provinces->{get_lang('name')} }}</td>
                            </tr>
                            <tr>
                                <td>รหัสไปรษณีย์ :</td>
                                <td>{{ $order[0]->postcode }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-5 col-sm-12 pt-4 border-left">
                        <h5><br></h5>
                        <table class="w-100 font-weight-normal" style="line-height: 1.8;">
                            <tr>
                                <td class="w-45">ราคาเต็ม</td>
                                <td class="text-right">฿{{ number_format($order[0]->total_amount, 2) }}</td>
                            </tr>
                            <tr class="text-danger">
                                <td>ส่วนลด</td>
                                <td class="text-right">- ฿{{ number_format($totalDiscount, 2) }}</td>
                            </tr>
                            <tr>
                                <td>ค่าจัดส่ง</td>
                                <td class="text-right">฿{{ number_format($order[0]->delivery_charge, 2) }}</td>
                            </tr>
                            <tr>
                                <td>ภาษี 7%</td>
                                <td class="text-right">฿{{ number_format($order[0]->vat, 2) }}</td>
                            </tr>
                        </table>
                        <h3 class="text-right mt-3 text-success">ยอดรวมทั้งสิ้น :
                            ฿{{ number_format($order[0]->total_amount + $order[0]->delivery_charge + $order[0]->vat, 2) }}
                        </h3>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row px-2">
                <div class="col-lg-2 offset-lg-6 col-md-3 offset-md-3 col-sm-4 px-1 pt-2">
                    <a href="#" class="btn btn-secondary border-0 w-100 {{ $order[0]->status < 3 ? 'disabled' : '' }}"
                        download="" {{ $order[0]->status < 3 ? 'disabled' : '' }}>ดาวน์โหลดใบเสร็จ</a>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 px-1 pt-2">
                    <button type="button" data-orderid="{{ $order[0]->id }}"
                        class="btn-cancel-order btn btn-danger border-0 w-100"
                        {{ $order[0]->status > 0 ? 'disabled' : '' }}>ยกเลิกคำสั่งซื้อ</button>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 px-1 pt-2">
                    <a href="{{ route('frontend.payment', ['locale' => get_lang(), 'orderCode' => $order[0]->code]) }}"
                        class="btn btn-success border-0 w-100 {{ $order[0]->status > 0 ? 'disabled' : '' }}"
                        {{ $order[0]->status > 0 ? 'disabled' : '' }}>แจ้งการชำระเงิน</a>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {

	});
</script>
@endpush
