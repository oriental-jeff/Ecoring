  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="name">ชื่อโซเชียล <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="name" name="name" value="{{  old('name') ?? $websocial->name }}" required="" />
          {{ $errors->first('name') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="url">URL :</label>
          <input type="text" class="form-control" id="url" name="url" value="{{  old('url') ?? $websocial->url }}" />
          {{ $errors->first('url') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="">รูปไอค่อน <span class="text-danger">*</span> :</label>
          <div class="icon">
            <div class="uploaded_image">
              <img id="preview_image" src="{{ $websocial->image ?? '' }}" class="img-icon" data-toggle="popover"  data-html="true"/>
            </div>
          </div>
          
          <div class="custom-file">
            <input type="file" 
             class="image" id="image" name="image" {{request()->route()->getActionMethod() == 'create' ? 'required' : ''}}>
            <label class="custom-file-label" for="image" >เลือกรูป</label>
          </div>
          <label class='text-pic'>ขนาดภาพที่แนะนำ 100x100 (ขนาดไม่เกิน 0.2 MB)</label>
            {{ $errors->first('image') }}
        </div>
      </div>
      
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" style='width: 100%;'>สถานะการใช้งาน : </label>
          @if(!empty($websocial) && $websocial->active == 'Inactive')
            <div class="radio radio-css radio-inline">
              <input class="form-check-input" type="radio" name="active" id="active1" value="1" >
              <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input class="form-check-input" type="radio" name="active" id="active2" value="0" checked>
              <label class="form-check-label ml-2" for="active2">ปิดใช้งาน</label>
            </div>
          @else
            <div class="radio radio-css radio-inline">
              <input class="form-check-input" type="radio" name="active" id="active1" value="1" checked>
              <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input class="form-check-input" type="radio" name="active" id="_IsActive2" value="0" >
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
       
