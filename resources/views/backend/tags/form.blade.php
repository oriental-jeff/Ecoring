<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_th">ชื่อเรียก (ไทย) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_th" name="name_th"
                    value="{{ old('name_th') ?? $tag->name_th }}" required="" />
                {{ $errors->first('name_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_en">ชื่อเรียก (อังกฤษ) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_en" name="name_en"
                    value="{{ old('name_en') ?? $tag->name_en }}" required="" />
                {{ $errors->first('name_en') }}
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
