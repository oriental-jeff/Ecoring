<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_th">ชื่อเรียก (ไทย) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_th" name="name_th"
                    value="{{ old('name_th') ?? $logistic->name_th }}" required="" />
                {{ $errors->first('name_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_en">ชื่อเรียก (อังกฤษ) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_en" name="name_en"
                    value="{{ old('name_en') ?? $logistic->name_en }}" required="" />
                {{ $errors->first('name_en') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="">รูป <span class="text-danger">*</span> :</label>
                <div class="icon">
                    <div class="uploaded_image">
                        <img id="preview_image" src="{{ $logistic->image ?? '' }}" class="img-icon"
                            data-toggle="popover" data-html="true" />
                    </div>
                </div>

                <div class="custom-file">
                    <input type="file" class="image" id="image" name="image" maxSizeByte="204800" fileType="image"
                        {{request()->route()->getActionMethod() == 'create' ? 'required' : ''}}>
                    <label class="custom-file-label" for="image">เลือกรูป</label>
                </div>
                <label class='text-pic'>ขนาดภาพที่แนะนำ 500 x 350 (ขนาดไม่เกิน 200 KB)</label>
                {{ $errors->first('image') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="period">ระยะเวลาในการจัดส่ง (โดยประมาณ) <span class="text-danger"> *
                    </span> :
                </label>
                <input type="text" class="form-control" id="period" name="period"
                    value="{{ old('period') ?? $logistic->period }}" required="" />
                {{ $errors->first('period') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="base_price">ราคาตั้งต้น <span class="text-danger"> * </span> :
                </label>
                <input type="number" min="0" step="any" class="form-control" id="base_price" name="base_price"
                    value="{{ old('base_price') ?? $logistic->base_price }}" required="" />
                {{ $errors->first('base_price') }}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-xl-6 col-md-12 col-lg-6 mt-2">
                <label class="col-form-label" style='width: 100%;'>สถานะการใช้งาน:</label>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1"
                        {{ (old('active') == 'Active' OR $logistic->active == 'Active') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
                </div>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0"
                        {{ (old('active') == 'Inactive' OR $logistic->active == 'Inactive') ? 'checked' : '' }}>
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
    });
</script>
@endpush
