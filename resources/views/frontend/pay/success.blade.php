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
                            href="{{ route('frontend.home', ['locale' => get_lang()]) }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">บันทึกใบสั่งซื้อสำเร็จ</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="mt-2 mb-5">
        <div class="container">
            <div class="box-paper border-top">
                <div class="box-head">
                    <img src="{{ asset('images/I-Checkmark1.svg') }}">
                    <h5>บันทึกใบสั่งซื้อ {{ $orderResult['code'] }} สำเร็จ</h5>
                </div>
                <div class="box-body">
                    <h5 class="text-color">ยอดรวมทั้งสิ้น : ฿{{ number_format($orderResult['total_amount'], 2) }}</h5>
                    <p>ระบบได้บันทึกใบสั่งซื้อสินค้าของท่านแล้ว กรุณาชำระเงิน ภายใน 24 ชั่วโมง
                        มายังบัญชีธนาคารของทางเว็บไซต์ ดังนี้</p>
                </div>

                <div class="row px-3 py-5">
                    @foreach ($bank_accounts as $bank_account)
                    <div class="col-lg-4 col-md-12 b-list">
                        <div class="box-bank">
                            <img src="{{ asset('images/icon-footer/icon-bank1.jpg') }}" class="img-bank" alt="">
                            <h6>{{ $bank_account->{get_lang('bank_name')} }}</h6>
                            ชื่อบัญชี {{ $bank_account->acc_name }}
                            <h5>หมายเลขบัญชี {{ $bank_account->acc_no }}</h5>
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
                    {{-- <div class="col-lg-4 col-md-12 b-list">
                        <div class="box-bank">
                            <img src="{{ asset('images/icon-footer/icon-bank1.jpg') }}" class="img-bank" alt="">
                    <h6>ธนาคารไทยพาณิชย์ - SCB</h6>
                    ชื่อบัญชี บริษัท อีโค่ริง จำกัด
                    <h5>หมายเลขบัญชี 054-52415-5</h5>
                </div>
                <img src="{{ asset('images/img-QRCode.jpg') }}" class="img-QRCode" alt="">
            </div>
            <div class="col-lg-4 col-md-6 b-list">
                <div class="box-bank">
                    <img src="{{ asset('images/icon-footer/icon-bank2.jpg') }}" class="img-bank" alt="">
                    <h6>ธนาคารกสิกรไทย - Kbank</h6>
                    ชื่อบัญชี บริษัท อีโค่ริง จำกัด
                    <h5>หมายเลขบัญชี 054-52415-5</h5>
                </div>
                <img src="{{ asset('images/img-QRCode.jpg') }}" class="img-QRCode" alt="">
            </div>
            <div class="col-lg-4 col-md-6 b-list">
                <div class="box-bank">
                    <img src="{{ asset('images/icon-footer/icon-bank5.jpg') }}" class="img-bank" alt="">
                    <h6>ธนาคารกรุงเทพ - Bangkok Bank</h6>
                    ชื่อบัญชี บริษัท อีโค่ริง จำกัด
                    <h5>หมายเลขบัญชี 054-52415-5</h5>
                </div>
                <img src="{{ asset('images/img-QRCode.jpg') }}" class="img-QRCode" alt="">
            </div> --}}
        </div>

        <div class="box-body">
            <p>หากท่านทำการชำระเงินเรียบร้อยแล้ว กรุณาแจ้งชำระเงินที่หน้าเว็บไซต์
                เพื่อให้เจ้าหน้าที่ทำการตรวจสอบความถูกต้องก่อนทำการจัดส่งสินค้า</p>
        </div>
        <div class="row pb-5 mx-auto" style="max-width: 500px;">
            <div class="col-6 px-1">
                <a href="{{ route('frontend.home', ['locale' => get_lang()]) }}"
                    class="btn btn-secondary border-0 w-100">กลับสู่หน้าหลัก</a>
            </div>
            <div class="col-6 px-1">
                <a href="{{ route('frontend.payment', ['locale' => get_lang(), 'orderCode' => $orderResult['code']]) }}"
                    class="btn border-0 w-100">แจ้งการชำระเงิน</a>
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
    });
</script>
@endpush
