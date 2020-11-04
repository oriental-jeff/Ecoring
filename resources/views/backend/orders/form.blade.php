<section class="box-history">
    <div class="container">
        {{-- Order Detail --}}
        <div class="box-detail">
            <h4 class="text-success">ข้อมูลการสั่งซื้อ</h4>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label-title">หมายเลขการสั่งซิ้อ : </label>
                    <label class="control-label-answer">{{ $order[0]->code }}</label>
                </div>

                <div class="col-md-12">
                    <label class="control-label-title">วันที่สั่งสินค้า : </label>
                    <label class="control-label-answer">{{ $order[0]->created_at->format('( D ) d/m/Y H:i:s') }}</label>
                </div>

                <div class="col-md-12">
                    <label class="control-label-title">สถานะ : </label>
                    <label class="control-label-answer">
                        {{ ($order[0]->status >= 3) ? $status[3]->{get_lang('name')} : $order[0]->status_config->{get_lang('name')} }}
                    </label>
                </div>

                <div class="col-md-12">
                    <label class="control-label-title">การชำระเงิน : </label>
                    <label class="control-label-answer">{{ $order[0]->payment_type }}</label>
                </div>
            </div>
        </div>

        {{-- Order List --}}
        <div class="box-detail"><br>
            <hr>
            <h4 class="text-success">รายการสั่งซื้อ</h4>
            <table id="data-table-list" class="table table-striped table-bordered w-100 nowrap">
                <thead>
                    <tr>
                        <td class="text-center">สินค้า</td>
                        <td class="text-center">จำนวน</td>
                        <td class="text-center">ราคาต่อหน่วย</td>
                        <td class="text-center">ราคารวม</td>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $totalDiscount = 0;
                    @endphp

                    @foreach ($order[0]->cart as $cart)
                    <tr>
                        <td class="text-left">
                            <img src="{{ $cart->product->image }}" class="img-table mr-2">
                            {{ $cart->product->{get_lang('name')} }}
                        </td>
                        <td class="text-center">{{ $cart->quantity }}</td>
                        <td class="text-right">
                            <b style="text-decoration: line-through; color: #ddd;">
                                ฿{{ number_format($cart->amount_full, 2) }}
                            </b><br>
                            ฿{{ number_format($cart->amount, 2) }}
                            @php
                                $totalDiscount += $cart->amount_full - $cart->amount;
                            @endphp
                        </td>
                        <td class="text-right">
                            ฿{{ number_format($cart->amount * $cart->quantity, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Order Information --}}
        <div class="box-total">
            <div class="row">
                <input type="hidden" id="pickup_optional" name="pickup_optional" value="{{ $order[0]->pickup_optional }}">

                {{-- Shipping Channel --}}
                <div class="col-lg-3 col-sm-5 pt-4 delivery_service">
                    <h4 class="text-success">ช่องทางการจัดส่ง</h4>
                    <img src="{{ $order[0]->logistic->image }}" class="img-Shipment">

                    <h5></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label-title">{{ $order[0]->logistic->{get_lang('name')} }}</label>
                        </div>

                        <div class="col-md-12">
                            <label class="control-label-title">ระยะเวลาการส่ง :</label>
                            <label class="control-label-answer">{{ $order[0]->logistic->period }}</label>
                        </div>

                        <div class="col-md-12">
                            <label class="control-label-title">อัตราค่าบริการ :</label>
                            <label class="control-label-answer">{{ number_format($order[0]->delivery_charge) }} บาท</label>
                        </div>
                    </div>
                </div>

                {{-- Delivery Service --}}
                <div class="col-lg-4 col-sm-7 pt-4 border-left delivery_service">
                    <h4 class="text-success">ที่อยู่ในการจัดส่ง</h4>
                    <div class="row mt-3 text-left">
                        <label class="col-md-4 control-label-title">ชื่อ :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->fullname }}</label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">เบอร์โทร :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->telephone }}</label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">ที่อยู่ :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->address }}</label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">แขวง / ตำบล :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->sub_districts->{get_lang('name')} }}</label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">เขต / อำเภอ :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->districts->{get_lang('name')} }}</label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">จังหวัด :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->provinces->{get_lang('name')} }}</label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">รหัสไปรษณีย์ :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->postcode }}</label>
                    </div>
                </div>

                {{-- Pickup Store --}}
                <div class="col-lg-7 col-sm-12 pt-4 border-left pickup_store">
                    <h4 class="text-success">มารับสินค้าเอง</h4>
                    <div class="row mt-3 text-left">
                        <label class="col-md-4 control-label-title">ชื่อผู้รับ :</label>
                        <label class="col-md-8 control-label-answer">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">ที่อยู่ :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->address }}</label>
                    </div>

                    <div class="row text-left">
                        <label class="col-md-4 control-label-title">เบอร์โทร :</label>
                        <label class="col-md-8 control-label-answer">{{ $order[0]->telephone }}</label>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="col-lg-5 col-sm-12 pt-4 border-left">
                    <h4 class="text-success">ยอดรวม</h4>
                    <div class="row mt-3">
                        <label class="col-md-4 control-label-title text-left">ราคาเต็ม :</label>
                        <label class="col-md-8 control-label-answer text-right">
                            {{ number_format($order[0]->total_amount, 2) }} บาท
                        </label>
                    </div>

                    <div class="row">
                        <label class="col-md-4 control-label-red text-left">ส่วนลด :</label>
                        <label class="col-md-8 control-label-red text-right">- {{ number_format($totalDiscount, 2) }} บาท</label>
                    </div>

                    <div class="row">
                        <label class="col-md-4 control-label-title text-left">ค่าจัดส่ง :</label>
                        <label class="col-md-8 control-label-answer text-right">{{ number_format($order[0]->delivery_charge, 2) }} บาท</label>
                    </div>

                    <div class="row">
                        <label class="col-md-4 control-label-title text-left">ภาษี 7 % :</label>
                        <label class="col-md-8 control-label-answer text-right">{{ number_format($order[0]->vat, 2) }} บาท</label>
                    </div>

                    <div class="row">
                        <label class="col-md-12 control-label-jumbo text-right">
                            ยอดรวมทั้งสิ้น : {{ number_format($order[0]->total_amount + $order[0]->delivery_charge + $order[0]->vat, 2) }} บาท
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row px-2">
            <div class="col-lg-2 offset-lg-6 col-md-3 offset-md-3 col-sm-4 px-1 pt-2">
                {{-- <button type="button" data-orderid="{{ $order[0]->id }}"
                class="btn-cancel-order btn btn-danger border-0 w-100"
                {{ $order[0]->status > 0 ? 'disabled' : '' }}>ยกเลิกคำสั่งซื้อ</button> --}}
            </div>

            <div class="col-lg-2 col-md-3 col-sm-4 px-1 pt-2">
                <button type="button" class="btn btn-block btn-outline-primary" onclick="sendMail('{{ $order[0]->id }}', 'invoice')">
                    <i class="fal fa-lg fa-file-invoice"></i> ส่งใบแจ้งหนี้ ( Invoice )
                </button>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-4 px-1 pt-2">
                <button type="button" class="btn btn-block btn-outline-success" onclick="sendMail('{{ $order[0]->id }}', 'receipt')">
                    <i class="fal fa-lg fa-file-invoice-dollar"></i> ส่งใบเสร็จ ( Receipt )
                </button>
            </div>
        </div>
    </div>
</section>

<div class="form-row">
    <div class="form-group col-xl-3 col-md-12 col-lg-3">
        <label class="control-label-title">สถานะ :</label>
        <select id="status" name="status" class="form-control">
            @foreach ($status as $item)
            <option value="{{ $item->status_id }}" {{ $order[0]->status == $item->status_id ? 'selected' : '' }}>
                {{ $item->name_th }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-xl-3 col-md-12 col-lg-3">
        <label class="control-label-title" for="tracking_no">Tracking No. :</label>
        <input type="text" class="form-control" id="tracking_no" name="tracking_no"
            value="{{ old('tracking_no') ?? $order[0]->tracking_no }}" />
        {{ $errors->first('tracking_no') }}
    </div>
</div>
<hr>
<div class="form-row mt-2">
    <div class="form-group col-12 text-left">
        <button type="submit" class="btn btn-white"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i> ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>


@push('after-scripts')
    <script>
        function sendMail(order_id, type) {
            let url = '';

            if (type == 'invoice') {
                url = '/backend/orders/send_mail_invoice';
            } else {
                url = '/backend/orders/send_mail_receipt';
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: {order_id: order_id},
                success: function(res) {
                    alert(res.message);
                 },
                error: function(err) { console.error(err); }
            });
        }

        $(document).ready(function() {
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
