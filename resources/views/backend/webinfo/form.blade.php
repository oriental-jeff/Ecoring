  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="name_th">ชื่อเว็บไซต์ (ไทย) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="name_th" name="name_th" value="{{ old('name_th') ?? $webinfo->name_th }}" required="" />
          {{ $errors->first('name_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="name_en">ชื่อเว็บไซต์ (อังกฤษ) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') ?? $webinfo->name_en }}" required="" />
          {{ $errors->first('name_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="description_th">รายละเอียดเว็บไซต์ (ไทย) <span class="text-danger"> * </span> : </label>
          <textarea name="description_th"  class="form-control" id="description_th" name="description_th"  required="" rows="4">{{ old('description_th') ?? $webinfo->description_th }}</textarea>
          {{ $errors->first('description_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="description_en">รายละเอียดเว็บไซต์ (อังกฤษ) <span class="text-danger"> * </span> : </label>
          <textarea name="description_en"  class="form-control" id="description_en" name="description_en"  required="" rows="4">{{ old('description_en') ?? $webinfo->description_en }}</textarea>
          {{ $errors->first('description_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="copyright_th">CopyRight (ไทย) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="copyright_th" name="copyright_th" value="{{  old('copyright_th') ?? $webinfo->copyright_th }}" required="" />
          {{ $errors->first('copyright_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="copyright_en">CopyRight (อังกฤษ) <span class="text-danger"> * </span> : </label>
          <input type="text" class="form-control" id="copyright_en" name="copyright_en" value="{{  old('copyright_en') ?? $webinfo->copyright_en }}" required="" />
          {{ $errors->first('copyright_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_name_th">ชื่อบริษัท (ไทย) : </label>
          <input type="text" class="form-control" id="company_name_th" name="company_name_th" value="{{  old('company_name_th') ?? $webinfo->company_name_th }}" />
          {{ $errors->first('company_name_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_name_en">ชื่อบริษัท (อังกฤษ) : </label>
          <input type="text" class="form-control" id="company_name_en" name="company_name_en" value="{{  old('company_name_en') ?? $webinfo->company_name_en }}" />
          {{ $errors->first('company_name_en') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_address_th">ที่อยู่ (ไทย) : </label>
          <textarea name="company_address_th"  class="form-control" id="company_address_th" name="company_address_th"  rows="4">{{  old('company_address_th') ?? $webinfo->company_address_th }}</textarea>
          {{ $errors->first('company_address_th') }}
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_address_en">ที่อยู่ (อังกฤษ) : </label>
          <textarea name="company_address_en"  class="form-control" id="company_address_en" name="company_address_en"  rows="4">{{  old('company_address_en') ?? $webinfo->company_address_en }}</textarea>
          {{ $errors->first('company_address_en') }}
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_tax_code">เลขภาษีเงินได้นิติบุคคล : </label>
          <input type="text" class="form-control" id="company_tax_code" name="company_tax_code" value="{{  old('company_tax_code') ?? $webinfo->company_tax_code }}" />
          {{ $errors->first('company_tax_code') }}
        </div>

         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_email">Email บริษัท <span class="text-danger"> * </span> : </label>
          <input type="email" class="form-control" id="company_email" name="company_email" value="{{  old('company_email') ?? $webinfo->company_email }}" required="" />
          {{ $errors->first('company_email') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_tel">หมายเลขโทรศัพท์ : </label>
          <input type="text" class="form-control" id="company_tel" name="company_tel" value="{{  old('company_tel') ?? $webinfo->company_tel }}" />
          {{ $errors->first('company_tel') }}
        </div>

         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="company_fax">หมายเลขแฟกซ์ : </label>
          <input type="text" class="form-control" id="company_fax" name="company_fax" value="{{  old('company_fax') ?? $webinfo->company_fax }}" />
          {{ $errors->first('company_fax') }}
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="">โลโก้ส่วนหัว <span class="text-danger">*</span> :</label>
          <div class="icon">
            <div class="uploaded_image">
              <img id="preview_image_logo_head" src="{{ $webinfo->logo_head }}" class="img-icon"  data-toggle='popover'  data-html="true"/>
            </div>
          </div>
          <div class="custom-file">
            <input type="file" 
             class="" id="image_logo_head" name="image_logo_head" >
            <label class="custom-file-label" for="image_logo_head">เลือกรูป</label>
          </div>
          <label class="text-pic">ขนาดภาพที่แนะนำ 50x200 (ขนาดไม่เกิน 0.5 MB)</label>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          <label class="">โลโก้ส่วนท้าย <span class="text-danger">*</span> :</label>
          <div class="icon">
            <div class="uploaded_image">
              <img id="preview_image_logo_foot" src="{{ $webinfo->logo_foot }}" class="img-icon"  data-toggle='popover' data-html="true" />
            </div>
          </div>
          <div class="custom-file">
            <input type="file" 
             class="" id="image_logo_foot" name="image_logo_foot" >>
            <label class="custom-file-label" for="image_logo_foot">เลือกรูป</label>
          </div>
          <label class="text-pic">ขนาดภาพที่แนะนำ 50x200 (ขนาดไม่เกิน 0.5 MB)</label>
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
      rules: {
        company_email: {
          email: true
        }
      }, 
    });

    $('#image_logo_head').on('change', function(){
       readURL(this, "preview_image_logo_head");
    });

    $('#image_logo_foot').on('change', function(){
       readURL(this, "preview_image_logo_foot");
    });

  });
</script>
@endpush