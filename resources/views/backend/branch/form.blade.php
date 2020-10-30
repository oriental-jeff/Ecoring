<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_th">ชื่อสาขา (ไทย) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_th" name="name_th"
                    value="{{ old('name_th') ?? $branch->name_th }}" required="" />
                {{ $errors->first('name_th') }}
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="name_en">ชื่อสาขา (อังกฤษ) <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="name_en" name="name_en"
                    value="{{ old('name_en') ?? $branch->name_en }}" required="" />
                {{ $errors->first('name_en') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="address_th">ที่อยู่ (ไทย) <span class="text-danger"> * </span> :
                </label>
                <textarea name="address_th" class="form-control" id="address_th" name="address_th" rows="2"
                    required="">{{  old('address_th') ?? $branch->address_th }}</textarea>
                {{ $errors->first('address_th') }}
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="address_en">ที่อยู่ (อังกฤษ) <span class="text-danger"> * </span> :
                </label>
                <textarea name="address_en" class="form-control" id="address_en" name="address_en" rows="2"
                    required="">{{  old('address_en') ?? $branch->address_en }}</textarea>
                {{ $errors->first('address_en') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="telephone">เบอร์ติดต่อ <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="telephone" name="telephone"
                    value="{{ old('telephone') ?? $branch->telephone }}" required="" />
                {{ $errors->first('telephone') }}
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="office_hours">เวลาเปิด - ปิด <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="office_hours" name="office_hours"
                    value="{{ old('office_hours') ?? $branch->office_hours }}" required="" />
                {{ $errors->first('office_hours') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="description_th">รายละเอียด (ไทย) : </label>
                <textarea name="description_th" class="form-control" id="description_th" name="description_th"
                    rows="2">{{  old('description_th') ?? $branch->description_th }}</textarea>
                {{ $errors->first('description_th') }}
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="description_en">รายละเอียด (อังกฤษ) : </label>
                <textarea name="description_en" class="form-control" id="description_en" name="description_en"
                    rows="2">{{  old('description_en') ?? $branch->description_en }}</textarea>
                {{ $errors->first('description_en') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="location">Location (Google Map Embed) <span class="text-danger"> *
                    </span> : </label>
                <textarea name="location" class="form-control" id="location" name="location"
                    rows="3">{{  old('location') ?? $branch->location }}</textarea>
                {{ $errors->first('location') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="">รูปสาขา <span class="text-danger">*</span> :</label>
                <div class="icon">
                    <div class="uploaded_image">
                        <img id="preview_image" src="{{ $branch->image ?? '' }}" class="img-icon" data-toggle="popover"
                            data-html="true" />
                    </div>
                </div>

                <div class="custom-file">
                    <input type="file" class="image" id="image" name="image"
                        {{request()->route()->getActionMethod() == 'create' ? 'required' : ''}}>
                    <label class="custom-file-label" for="image">เลือกรูป</label>
                </div>
                <label class='text-pic'>ขนาดภาพที่แนะนำ 1920x1080 (ขนาดไม่เกิน 5 MB)</label>
                {{ $errors->first('image') }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-12 col-lg-6">
                <label class="col-form-label" style='width: 100%;'>สถานะการใช้งาน : </label>
                @if(!empty($branch) && $branch->active == 'Inactive')
                <div class="radio radio-css radio-inline Me-2">
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1">
                    <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
                </div>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0" checked>
                    <label class="form-check-label ml-2" for="active2">ปิดใช้งาน</label>
                </div>
                @else
                <div class="radio radio-css radio-inline Me-2">
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1" checked>
                    <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
                </div>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="_IsActive2" value="0">
                    <label class="form-check-label ml-2" for="_IsActive2">ปิดใช้งาน</label>
                </div>
                @endif
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
          ImageMaxWidth: 1920 //image max width 1920 px
        }
      },
      messages: {
        image: {
          ImageMaxWidth: "ความกว้างของรูปไม่เกิน 1920 pixels"
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
