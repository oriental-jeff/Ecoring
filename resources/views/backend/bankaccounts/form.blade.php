<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="bank_name_th">ชื่อธนาคาร (ไทย) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="bank_name_th" name="bank_name_th"
                    value="{{ old('bank_name_th') ?? $bankaccount->bank_name_th }}" required="" />
                {{ $errors->first('bank_name_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="bank_name_en">ชื่อธนาคาร (อังกฤษ) <span class="text-danger"> *
                    </span>
                    :
                </label>
                <input type="text" class="form-control" id="bank_name_en" name="bank_name_en"
                    value="{{ old('bank_name_en') ?? $bankaccount->bank_name_en }}" required="" />
                {{ $errors->first('bank_name_en') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="">โลโก้ธนาคาร <span class="text-danger">*</span> :</label>
                <div class="icon">
                    <div class="uploaded_image">
                        <img id="preview_image" src="{{ $bankaccount->image ?? '' }}" class="img-icon"
                            data-toggle="popover" data-html="true" />
                    </div>
                </div>

                <div class="custom-file">
                    <input type="file" class="image" id="image" name="image" maxSizeByte="40960" fileType="image"
                        {{request()->route()->getActionMethod() == 'create' ? 'required' : ''}}>
                    <label class="custom-file-label" for="image">เลือกรูป</label>
                </div>
                <label class='text-pic'>ขนาดภาพที่แนะนำ 100 x 100 (ขนาดไม่เกิน 40 KB)</label>
                {{ $errors->first('image') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="acc_no">เลขที่บัญชี <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="acc_no" name="acc_no"
                    value="{{ old('acc_no') ?? $bankaccount->acc_no }}" required="" />
                {{ $errors->first('acc_no') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="acc_name">ชื่อเรียกบัญชี <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="acc_name" name="acc_name"
                    value="{{ old('acc_name') ?? $bankaccount->acc_name }}" required="" />
                {{ $errors->first('acc_name') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="">รูป QR Code :</label>
                <div class="icon">
                    <div class="uploaded_image">
                        <img id="preview_image_qrcode" src="{{ $bankaccount->image_qrcode ?? '' }}" class="img-icon"
                            data-toggle="popover" data-html="true" />
                    </div>
                </div>

                <div class="custom-file">
                    <input type="file" class="image" id="image_qrcode" name="image_qrcode" maxSizeByte="40960"
                        fileType="image" {{request()->route()->getActionMethod() == 'create' ? '' : ''}}>
                    <label class="custom-file-label" for="image_qrcode">เลือกรูป</label>
                </div>
                <label class='text-pic'>ขนาดภาพที่แนะนำ 100 x 100 (ขนาดไม่เกิน 40 KB)</label>
                {{ $errors->first('image_qrcode') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="linkurl">ลิ้งค์ :
                </label>
                <input type="text" class="form-control" id="linkurl" name="linkurl" placeholder="https://"
                    value="{{ old('linkurl') ?? $bankaccount->linkurl }}" />
                {{ $errors->first('linkurl') }}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-xl-6 col-md-12 col-lg-6 mt-2">
                <label class="col-form-label" style='width: 100%;'>สถานะการใช้งาน:</label>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1"
                        {{ (old('active') == 'Active' OR $bankaccount->active == 'Active') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
                </div>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0"
                        {{ (old('active') == 'Inactive' OR $bankaccount->active == 'Inactive') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="active2">ปิดใช้งาน</label>
                </div>
            </div>
        </div>

    </div> <!-- col6 -->
</div> <!-- row -->
<hr>
<div class="form-group row mt-2">
    <div class="col-12 text-left">
        <button type="submit" class="btn btn-white"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i> ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>


@push('after-scripts')
<script>
    $(function(){
        $('#image').on('change', function(){
            readURL(this, "preview_image");
        });
        $('#image_qrcode').on('change', function(){
            readURL(this, "preview_image_qrcode");
        });
    });
</script>
@endpush
