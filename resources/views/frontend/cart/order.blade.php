@extends('frontend.layouts.main')
@push('after-css')
<link href="{{ asset('css/frontend/cart-order.css?v') . time() }}" rel="stylesheet" />
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
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.cart', ['locale' => get_lang()]) }}">ตะกร้าสินค้า</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">คำสั่งซื้อ</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="box-history">
        <form class="form-horizontal" method="post" id="pay-form-validate" name="demo-form"
            enctype="multipart/form-data" action="{{ route('frontend.pay', ['locale' => get_lang()]) }}">
            @method('post')
            <div class="container">
                <h4>คำสั่งซื้อ</h4>
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
                    $totalWeight = 0;
                    @endphp
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
                                <span>{{ $cart->quantity }}</span>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 text-center display-price">
                            <b class="line-through">฿{{ number_format($cart->product->full_price) }}</b><br>
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

                <div class="row font-weight-normal mb-4">
                    <div class="offset-lg-8 col-lg-2 offset-md-6 col-md-3 offset-2 col-5 text-center">
                        <h5>ราคารวม</h5>
                    </div>
                    <div class="col-lg-2 col-md-3 col-5 text-center display-total">
                        <h5>฿<span>0.00</span></h5>
                    </div>
                </div>

                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1">
                        <a href="{{ URL::previous() }}" class="btn btn-secondary border-0 w-100">ย้อนกลับ</a>
                    </div>
                </div>

                <hr>

                <div class="box-Shipment font-weight-normal t2">
                    <h5>เลือกช่องทางการจัดส่ง</h5>
                    <div class="row">
                        @foreach ($logistics as $k => $logistic)
                        <div class="col-md-4 logisticScope">
                            <input class="box-check" type="radio" name="logistic_id" id="logistic_id{{ $k }}"
                                value="{{ $logistic->id }}" {{ $k === 0 ? 'checked' : '' }}>
                            <label class="box-check-label" for="logistic_id{{ $k }}">
                                <img src="{{ url($logistic->image) }}" class="img-Shipment">
                                <h5>{{ $logistic->{get_lang('name')} }}</h5>
                                ระยะเวลาการส่ง : <span class="period">{{ $logistic->period }}</span><br>
                                อัตราค่าบริการ : <span class="base_price">{{ number_format($logistic->logistic_price) }}
                                    บาท<br>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="box-Shipment font-weight-normal">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>เลือกที่อยู่ในการจัดส่ง</h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <!-- Button trigger modal -->
                            <button id="customeAddr" disabled type="button" class="btn btn-secondary"
                                data-toggle="modal" data-target="#customeAddrModalCenter">
                                เลือกที่อยู่ในการจัดส่งเพิ่มเติม
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="customeAddrModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="customeAddrModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">เลือกที่อยู่ในการจัดส่ง
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($delivery_addr as $k => $da)
                                            <div class="row text-left">
                                                <div class="col-lg-2">
                                                    <input class="box-check" type="radio" name="opt" id="opt{{$k}}"
                                                        value="{{ $da->id }}" data-ref="{{ $da }}"
                                                        {{ $da->default === 1 ? 'checked' : '' }}>
                                                </div>
                                                <div class="col-lg-10">
                                                    <label class="box-check-label" for="opt{{$k}}">
                                                        <table>
                                                            <tr>
                                                                <td>เบอร์โทร :</td>
                                                                <td><input type="text" id="custom_mobile{{ $da->id }}"
                                                                        name="custom_mobile{{ $da->id }}"
                                                                        value="{{ $da->telephone }}" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td>ที่อยู่ :</td>
                                                                <td><input type="text" id="custom_address{{ $da->id }}"
                                                                        name="custom_address{{ $da->id }}"
                                                                        value="{{ $da->address }}" readonly>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>แขวง/ตำบล :</td>
                                                                <td><input type="text"
                                                                        id="custom_sub_district_id{{ $da->id }}"
                                                                        name="custom_sub_district_id{{ $da->id }}"
                                                                        value="{{ $da->sub_districts->{get_lang('name')} }}"
                                                                        readonly>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>เขต/อำเภอ :</td>
                                                                <td><input type="text"
                                                                        id="custom_district_id{{ $da->id }}"
                                                                        name="custom_district_id{{ $da->id }}"
                                                                        value="{{ $da->districts->{get_lang('name')} }}"
                                                                        readonly>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>จังหวัด :</td>
                                                                <td><input type="text"
                                                                        id="custom_province_id{{ $da->id }}"
                                                                        name="custom_province_id{{ $da->id }}"
                                                                        value="{{ $da->provinces->{get_lang('name')} }}"
                                                                        readonly>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>รหัสไปรษณีย์ :</td>
                                                                <td><input type="text" id="custom_postcode{{ $da->id }}"
                                                                        name="custom_postcode{{ $da->id }}"
                                                                        value="{{ $da->postcode }}" readonly></td>
                                                            </tr>
                                                        </table>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" onclick="getCustomData()" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- User Info ID -->
                            <input class="box-check" type="radio" name="delivery_addr" id="delivery_addr_profile"
                                value="profile" checked>
                            <label class="box-check-label" for="delivery_addr_profile">
                                ที่อยู่โปรไฟล์
                                <table>
                                    <tr>
                                        <td style="min-width: 100px;">ชื่อ :</td>
                                        <td>
                                            <input type="hidden" id="profile_id" name="profile_id"
                                                value="{{ Auth::id() }}">
                                            <input type="text" id="profile_fullname" name="profile_fullname"
                                                value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td>เบอร์โทร :</td>
                                        <td><input type="text" id="profile_mobile" name="profile_mobile"
                                                value="{{ Auth::user()->profiles->telephone }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่ :</td>
                                        <td><input type="text" id="profile_address" name="profile_address"
                                                value="{{ Auth::user()->profiles->address }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>แขวง/ตำบล :</td>
                                        <td><input type="text" id="profile_sub_district_id"
                                                name="profile_sub_district_id"
                                                value="{{ Auth::user()->profiles->sub_districts->{get_lang('name')} }}"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td>เขต/อำเภอ :</td>
                                        <td><input type="text" id="profile_district_id" name="profile_district_id"
                                                value="{{ Auth::user()->profiles->districts->{get_lang('name')} }}"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td>จังหวัด :</td>
                                        <td><input type="text" id="profile_province_id" name="profile_province_id"
                                                value="{{ Auth::user()->profiles->provinces->{get_lang('name')} }}"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td>รหัสไปรษณีย์ :</td>
                                        <td><input type="text" id="profile_postcode" name="profile_postcode"
                                                value="{{ Auth::user()->profiles->postcode }}" readonly></td>
                                    </tr>
                                </table>

                            </label>
                        </div>
                        <div class="col-lg-6">
                            <!-- Address Delivery ID -->
                            <input class="box-check" type="radio" name="delivery_addr" id="delivery_addr_custom"
                                value="custom">
                            <label class="box-check-label" for="delivery_addr_custom">
                                แก้ไขที่อยู่ที่ต้องการจัดส่ง
                                <table>
                                    <tr>
                                        <td style="min-width: 100px;">ชื่อ :</td>
                                        <td>
                                            <input type="hidden" id="custom_id" name="custom_id"
                                                value="{{ Auth::id() }}">
                                            <input type="text" id="custom_fullname" name="custom_fullname"
                                                value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td>เบอร์โทร :</td>
                                        <td><input type="text" id="custom_mobile" name="custom_mobile"
                                                value="{{ Auth::user()->address_deliveries_default->telephone }}"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่ :</td>
                                        <td><input type="text" id="custom_address" name="custom_address"
                                                value="{{ Auth::user()->address_deliveries_default->address }}"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>แขวง/ตำบล :</td>
                                        <td><input type="text" id="custom_sub_district_id" name="custom_sub_district_id"
                                                value="{{ Auth::user()->address_deliveries_default->sub_districts->{get_lang('name')} }}"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>เขต/อำเภอ :</td>
                                        <td><input type="text" id="custom_district_id" name="custom_district_id"
                                                value="{{ Auth::user()->address_deliveries_default->districts->{get_lang('name')} }}"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>จังหวัด :</td>
                                        <td><input type="text" id="custom_province_id" name="custom_province_id"
                                                value="{{ Auth::user()->address_deliveries_default->provinces->{get_lang('name')} }}"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>รหัสไปรษณีย์ :</td>
                                        <td><input type="text" id="custom_postcode" name="custom_postcode"
                                                value="{{ Auth::user()->profiles->postcode }}" readonly></td>
                                    </tr>
                                </table>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                        <a href="{{ route('frontend.product', ['locale' => get_lang()]) }}"
                            class="btn btn-secondary border-0 w-100">ซื้อสินค้าเพิ่ม</a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1">
                        <a href="javascript:void(0);" onclick="$('#pay-form-validate').submit();"
                            class="btn border-0 w-100 btn-next-process">ดำเนินการต่อ</a>
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
        $('input[type=radio][name=delivery_addr]').on('change', function() {
            $('#customeAddr').attr('disabled', true);
            if ($(this).val() === 'custom') $('#customeAddr').attr('disabled', false);
        });
    });
    // custom delivery address
    function getCustomData() {
        let d = $('input[name=opt]:checked').data('ref');
        // add data to input form
        $('#custom_id').val(d.id);
        $('#custom_address').val($('#custom_address' + d.id).val());
        $('#custom_mobile').val($('#custom_mobile' + d.id).val());
        $('#custom_sub_district_id').val($('#custom_sub_district_id' + d.id).val());
        $('#custom_district_id').val($('#custom_district_id' + d.id).val());
        $('#custom_province_id').val($('#custom_province_id' + d.id).val());
        $('#custom_postcode').val($('#custom_postcode' + d.id).val());

        $('#customeAddrModalCenter').modal('hide');
    }
</script>
@endpush