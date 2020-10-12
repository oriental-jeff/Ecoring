<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <h4>หมายเลขสั่งซื้อ: {{ $payment_notification->orders_code }}</h4>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <a href="{{ route('backend.orders.edit', ['order' => $payment_notification->order->id]) }}"
                    target="_blank"
                    class="btn {{ $payment_notification->order ? 'btn-success' : 'btn-danger disabled' }}">{{ $payment_notification->order ? 'ดูข้อมูลการสั่งซื้อนี้' : 'ไม่พบข้อมูลการสั่งซื้อนี้ !!' }}</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2" style="font-size: 16px">
                <h4>รายละเอียดการชำระ:</h4>
                <div>เลขที่บัญชี: {{ $payment_notification->bank_account_info->acc_no }}</div>
                <div>ชื่อธนาคาร: {{ $payment_notification->bank_account_info->bank_name_th }}</div>
                <div>ชื่อผู้ทำรายการ: {{ $payment_notification->fullname }}</div>
                <div>เบอร์ติดต่อ: {{ $payment_notification->contact }}</div>
                <div>อีเมล์: {{ $payment_notification->email }}</div>
                <div>วันที่ทำรายการ: {{ $payment_notification->payment_datetime }}</div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 float-right">
                <h4>หลักฐานการโอน:</h4>
                <a href="{{ asset($payment_notification->image) ?? 'javascript:void(0);' }}" target="_blank">
                    <img src="{{ $payment_notification->image ?? '' }}" style="width:240px">
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group col-xl-6 col-md-12 col-lg-6 mt-2">
                <label class="col-form-label" style='width: 100%;'>สถานะ:</label>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="status" id="status1" value="0"
                        {{ (old('status') == 'New' OR $payment_notification->status == 'New') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="status1">New</label>
                </div>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="status" id="status2" value="1"
                        {{ (old('status') == 'Done' OR $payment_notification->status == 'Done') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="status2">Done</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row mt-2">
    <div class="col-12 text-left">
        <button type="submit" class="btn btn-white"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i>
            ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>
