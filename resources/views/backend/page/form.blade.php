  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="name">ชื่อหน้า <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control " id="name" name="name" value="{{ old('name') ?? $page->name }}" readonly required="" />
          {{ $errors->first('name') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="route_name">Link :</label>
          <input type="text" class="form-control" id="route_name" name="route_name" value="{{ old('route_name') ?? $page->route_name }}" readonly />
          {{ $errors->first('route_name') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="title_th">Title (ไทย) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="title_th" name="title_th" value="{{ old('title_th') ?? $page->title_th }}" required="" />
          {{ $errors->first('title_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="title_en">Title (อังกฤษ) <span class="text-danger"> * </span> :</label>
          <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en') ?? $page->title_en }}" required="" />
          {{ $errors->first('title_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="meta_title_th">Meta Title (ไทย) : </label>
          <textarea name="meta_title_th" class="form-control" id="meta_title_th" name="meta_title_th" rows='2'>{{  old('meta_title_th') ?? $page->meta_title_th }}</textarea>
          {{ $errors->first('meta_title_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="meta_title_en">Meta Title (อังกฤษ) : </label>
          <textarea name="meta_title_en" class="form-control" id="meta_title_en" name="meta_title_en" rows='2'>{{  old('meta_title_en') ?? $page->meta_title_en }}</textarea>
          {{ $errors->first('meta_title_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="meta_description_th">Meta Description (ไทย) : </label>
          <textarea name="meta_description_th" class="form-control" id="meta_description_th" name="meta_description_th" rows='4'>{{  old('meta_description_th') ?? $page->meta_description_th }}</textarea>
          {{ $errors->first('meta_description_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="meta_description_en">Meta Description (อังกฤษ) : </label>
          <textarea name="meta_description_en" class="form-control" id="meta_description_en" name="meta_description_en" rows='4'>{{  old('meta_description_en') ?? $page->meta_description_en }}</textarea>
          {{ $errors->first('meta_description_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="meta_description_th">Meta Keyword (ไทย) : </label>
          <textarea name="meta_keyword_th" class="form-control" id="meta_keyword_th" name="meta_keyword_th" rows='2'>{{  old('meta_keyword_th') ?? $page->meta_keyword_th }}</textarea>
          {{ $errors->first('meta_keyword_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="meta_keyword_en">Meta Keyword (อังกฤษ) : </label>
          <textarea name="meta_keyword_en" class="form-control" id="meta_keyword_en" name="meta_keyword_en" rows='2'>{{  old('meta_keyword_en') ?? $page->meta_keyword_en }}</textarea>
          {{ $errors->first('meta_keyword_en') }}
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

    $('#image').on('change', function(){
     readURL(this, "preview_image");
    });
  });
  </script>
@endpush
       
