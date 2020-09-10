  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="title_th">ชื่อโครงการ (ไทย) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="title_th" name="title_th" value="{{ old('title_th') ?? $about->title_th }}" required="" />
          {{ $errors->first('title_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="title_en">ชื่อโครงการ (อังกฤษ) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en') ?? $about->title_en }}" required="" />
          {{ $errors->first('title_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="type_th">ประเภทโครงการ (ไทย) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="type_th" name="type_th" value="{{ old('type_th') ?? $about->type_th }}" required="" />
          {{ $errors->first('type_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="type_en">ประเภทโครงการ (อังกฤษ) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="type_en" name="type_en" value="{{ old('type_en') ?? $about->type_en }}" required="" />
          {{ $errors->first('type_en') }}
        </div>
      </div>

      <div class="card border mt-2">
        <div class="card-header">รายละเอียดโครงการ</div>
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
              <label class="" for="description1_th">รายละเอียด (ไทย) <span class="text-danger"> * </span> : </label>
              <textarea name="description1_th" class="form-control" id="description1_th" name="description1_th"  required="" rows="4">{{ old('description1_th') ?? $about->description1_th }}</textarea>
              {{ $errors->first('description1_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
              <label class="" for="description1_en">รายละเอียด (อังกฤษ) <span class="text-danger"> * </span> : </label>
              <textarea name="description1_en" class="form-control" id="description1_en" name="description1_en"  required="" rows="4">{{ old('description1_en') ?? $about->description1_en }}</textarea>
              {{ $errors->first('description1_en') }}
            </div>            
          </div>
        </div>
      </div>

      <div class="card border mt-2">
        <div class="card-header">ธีมโครงการ</div>
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
              <label class="" for="description2_th">รายละเอียด (ไทย) <span class="text-danger"> * </span> : </label>
              <textarea name="description2_th" class="form-control" id="description2_th" name="description2_th"  required="" rows="4">{{ old('description2_th') ?? $about->description2_th }}</textarea>
              {{ $errors->first('description2_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
              <label class="" for="description2_en">รายละเอียด (อังกฤษ) <span class="text-danger"> * </span> : </label>
              <textarea name="description2_en" class="form-control" id="description2_en" name="description2_en"  required="" rows="4">{{ old('description2_en') ?? $about->description2_en }}</textarea>
              {{ $errors->first('description2_en') }}
            </div>
          </div>
        </div>
      </div>

      <div class="card border mt-2">
        <div class="card-header">รายชื่อคณะกรรมการ</div>
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
              <label class="" for="description3_th">รายละเอียด (ไทย) <span class="text-danger"> * </span> : </label>
              <textarea name="description3_th" class="form-control" id="description3_th" name="description3_th"  required="" rows="4">{{ old('description3_th') ?? $about->description3_th }}</textarea>
              {{ $errors->first('description3_th') }}
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
              <label class="" for="description3_en">รายละเอียด (อังกฤษ) <span class="text-danger"> * </span> : </label>
              <textarea name="description3_en" class="form-control" id="description3_en" name="description3_en"  required="" rows="4">{{ old('description3_en') ?? $about->description3_en }}</textarea>
              {{ $errors->first('description3_en') }}
            </div>
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
      <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i class="fas fa-reply text-danger" ></i> ย้อนกลับ</button>      
    </div>
  </div>
       
@push('after-scripts')
  <script>
  $(function(){
    $('#form-validate').validate({
      errorPlacement: function(error, element) {
        if($(element).attr('id') == 'image'){
          error.insertAfter($(element).parent());
          $(element).siblings('.custom-file-label').toggleClass('error-border');
        } else {
          error.insertAfter(element);
        }
      }
    });

    CKEDITOR.replace('description1_th', {
      filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('description1_en', {
      filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('description2_th', {
      filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('description2_en', {
      filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('description3_th', {
      filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('description3_en', {
      filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });
  });
  </script>
@endpush