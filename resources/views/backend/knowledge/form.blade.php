<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="title_th">ชื่อเรื่อง (ไทย) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="title_th" name="title_th"
                    value="{{ old('title_th') ?? $knowledge->title_th }}" required="" />
                {{ $errors->first('title_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="title_en">ชื่อเรื่อง (อังกฤษ) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="title_en" name="title_en"
                    value="{{ old('title_en') ?? $knowledge->title_en }}" required="" />
                {{ $errors->first('title_en') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="" for="content_th">รายละเอียด (ไทย) <span class="text-danger"> *
                    </span> : </label>
                <textarea name="content_th" class="form-control" id="content_th" name="content_th"
                    required="" rows="4">{{ old('content_th') ?? $knowledge->content_th }}</textarea>
                {{ $errors->first('content_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="" for="content_en">รายละเอียด (อังกฤษ) <span class="text-danger"> *
                    </span> : </label>
                <textarea name="content_en" class="form-control" id="content_en" name="content_en"
                    required="" rows="4">{{ old('content_en') ?? $knowledge->content_en }}</textarea>
                {{ $errors->first('content_en') }}
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
    $(function() {
        // CKEDITOR
        CKEDITOR.replace('content_th', {
            filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('content_en', {
            filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    })
</script>
@endpush
