<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_th">ชื่อเรียก (ไทย) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_th" name="name_th"
                    value="{{ old('name_th') ?? $promotion->name_th }}" required="" />
                {{ $errors->first('name_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_en">ชื่อเรียก (อังกฤษ) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_en" name="name_en"
                    value="{{ old('name_en') ?? $promotion->name_en }}" required="" />
                {{ $errors->first('name_en') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="start_at">วันที่เริ่ม <span class="text-danger"> * </span> :
                </label>
                <input type="date" class="form-control datepicker-startdate valid" id="start_at" name="start_at"
                    value="{{ old('start_at') ?? $promotion->start_at }}" required="" />
                {{ $errors->first('start_at') }}
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="end_at">วันที่สิ้นสุด <span class="text-danger"> * </span> :
                </label>
                <input type="date" class="form-control datepicker-enddate valid" id="end_at" name="end_at"
                    value="{{ old('end_at') ?? $promotion->end_at }}" required="" />
                {{ $errors->first('end_at') }}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-xl-6 col-md-12 col-lg-6 mt-2">
                <label class="col-form-label" style='width: 100%;'>สถานะการใช้งาน:</label>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1"
                        {{ (old('active') == 'Active' OR $promotion->active == 'Active') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
                </div>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0"
                        {{ (old('active') == 'Inactive' OR $promotion->active == 'Inactive') ? 'checked' : '' }}>
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
