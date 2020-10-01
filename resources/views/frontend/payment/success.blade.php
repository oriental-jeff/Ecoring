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
                    <li class="breadcrumb-item active" aria-current="page">Payment</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="mt-2 mb-5">
        <div class="container">
            <div class="box-paper border-top">
                <div class="box-head">
                    <img src="{{ asset('images/I-Checkmark1.svg') }}">
                    <h5>แจ้งการชำระเงินสำเร็จ</h5>
                </div>
                {{-- <div class="box-body">
                    <h5 class="text-color">ยอดรวมทั้งสิ้น : ฿ 15,030.00</h5>
                    <p>ระบบจะทำการส่งใบเสร็จ ไปยังอีเมลที่ท่านใช้สมัครสมาชิก เจ้าหน้าที่จะทำการตรวจสอบความถูกต้องและ
                        จะทำการจัดส่งสินค้าให้ท่านเป็นลำดับถัดไป</p>
                </div> --}}
                <div class="box-btn">
                    <a href="{{ route('frontend.home', ['locale' => get_lang()]) }}"
                        class="btn btn-secondary border-0 d-block">กลับสู่หน้าหลัก</a>
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
    });
</script>
@endpush
