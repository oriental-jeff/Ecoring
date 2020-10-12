<section class="box-history">
    <div class="container">

        <div class="box-detail">
            <h5 class="text-success">ข้อมูลการสั่งซื้อ</h5>
            <div>หมายเลขการสั่งซิ้อ : <span class="">{{ $order[0]->code }}</span></div>
            <div>วันที่สั่งสินค้า : <span class="">{{ $order[0]->created_at->format("d/m/Y H:i:s") }}</span>
            </div>
            <div>สถานะ : <span
                    class="">{{ ($order[0]->status >= 3) ? $status[3]->{get_lang('name')} : $order[0]->status_config->{get_lang('name')} }}</span>
            </div>
            <div>การชำระเงิน : <span class="">{{ $order[0]->payment_type }}</span>
            </div>
        </div>

        <div class="box-detail"><br>
            <hr>
            <h5 class="text-success">รายการสั่งซื้อ</h5>
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
                        <td class="text-left"><img src="{{ $cart->product->image }}" class="img-table mr-2">
                            {{ $cart->product->{get_lang('name')} }}</td>
                        <td class="text-center">{{ $cart->quantity }}</td>
                        <td class="text-right"><b
                                style="text-decoration: line-through; color: #ddd;">฿{{ number_format($cart->amount_full, 2) }}</b><br>
                            ฿{{ number_format($cart->amount, 2) }}
                            @php
                            $totalDiscount += $cart->amount_full - $cart->amount;
                            @endphp</td>
                        <td class="text-right">฿{{ number_format($cart->amount * $cart->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                            <td>{{ $order[0]->fullname }}</td>
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
                {{-- <button type="button" data-orderid="{{ $order[0]->id }}"
                class="btn-cancel-order btn btn-danger border-0 w-100"
                {{ $order[0]->status > 0 ? 'disabled' : '' }}>ยกเลิกคำสั่งซื้อ</button> --}}
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 px-1 pt-2">
                <a href="#" class="btn btn-primary border-0 w-100">ส่งใบแจ้งหนี้</a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 px-1 pt-2">
                <a href="#" class="btn btn-success border-0 w-100">ส่งใบเสร็จ</a>
            </div>
        </div>
    </div>
</section>
<div class="form-row">
    <div class="form-group col-xl-3 col-md-12 col-lg-3">
        <label class="col-form-label" style='width: 100%;'>สถานะ:</label>
        <select id="status" name="status" class="form-control">
            @foreach ($status as $item)
            <option value="{{ $item->status_id }}" {{ $order[0]->status == $item->status_id ? 'selected' : '' }}>
                {{ $item->name_th }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-xl-3 col-md-12 col-lg-3">
        <label class="col-form-label" for="tracking_no">Tracking No.: </label>
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
