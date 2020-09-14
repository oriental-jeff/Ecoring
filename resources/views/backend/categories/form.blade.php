<div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="name_th">ชื่อเรียก (ไทย) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="name_th" name="name_th" value="{{ old('name_th') ?? $category->name_th }}" required="" />
          {{ $errors->first('name_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="name_en">ชื่อเรียก (อังกฤษ) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') ?? $category->name_en }}" required="" />
          {{ $errors->first('name_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="">รูป <span class="text-danger">*</span> :</label>
          <div class="icon">
            <div class="uploaded_image">
              <img id="preview_image" src="{{ $category->image ?? '' }}" class="img-icon" data-toggle="popover"  data-html="true"/>
            </div>
          </div>

          <div class="custom-file">
            <input type="file"
             class="image" id="image" name="image" {{request()->route()->getActionMethod() == 'create' ? 'required' : ''}}>
            <label class="custom-file-label" for="image" >เลือกรูป</label>
          </div>
          <label class='text-pic'>ขนาดภาพที่แนะนำ 500 x 350 (ขนาดไม่เกิน 200 KB)</label>
            {{ $errors->first('image') }}
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
  $('#image').change(function() {
    $('#image').removeData('imageWidth');
    $('#image').removeData('imageHeight');
    var file = this.files[0];
    var tmpImg = new Image();
    tmpImg.src=window.URL.createObjectURL( file );
    tmpImg.onload = function() {
      width = tmpImg.naturalWidth,
      height = tmpImg.naturalHeight;
      $('#image').data('imageWidth', width);
      $('#image').data('imageHeight', height);
    }
  });

  $.validator.addMethod('ImageMaxWidth', function(value, element, maxWidth) {
    if(element.files.length == 0){
      return true; // check here if file not added than return true for not check file dimention
    }
    var width = $(element).data('imageWidth');
    if(width <= maxWidth){
      return true;
    }else{
      return false;
    }
  });

  $(function(){
    $('#form-validate').validate({
      rules: {
        image: {
          ImageMaxWidth: 500 //image max width 500 px
        }
      },
      messages: {
        image: {
          ImageMaxWidth: "ความกว้างของรูปไม่เกิน 500 pixels"
        }
      },
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

