  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="email">Username :  </label>
          <input type="email" class="form-control " id="" name="email" value="{{ $user->email ?? old('email') }} " data-parsley-required="true" data-parsley-required-message="กรุณาใส่ข้อมูลTag" placeholder="" maxlength="100" readonly/>
           {{ $errors->first('email')}}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="first_name">ชื่อ : </label>
          <input type="text" class="form-control " id="first_name" name="first_name" value="{{ $user->first_name ?? old('first_name') }}" />
          {{ $errors->first('first_name')  }}
        </div>
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="last_name">นามสกุล : </label>
          <input type="text" class="form-control " id="last_name" name="last_name" value="{{ $user->last_name ?? old('last_name') }}" />
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="old_password">Old Password :  </label>
          <input type="password" class="form-control" id="old_password" name="old_password" value="{{ old('old_password') ?? '' }}" data-parsley-required="true" data-parsley-required-message="กรุณาใส่ข้อมูลTag" placeholder="" maxlength="100" />
           {{ $errors->first('old_password')}}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="password">New Password :  </label>
          <input type="password" class="form-control" id="password" name="password" value="{{ old('password') ?? '' }}" data-parsley-required="true" data-parsley-required-message="กรุณาใส่ข้อมูลTag" placeholder="" maxlength="100" />
           {{ $errors->first('password')}}
        </div>
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class="col-form-label" for="password">Confirm New Password :  </label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{  old('password_confirmation') ?? '' }}" data-parsley-required="true" data-parsley-required-message="กรุณาใส่ข้อมูลTag" placeholder="" maxlength="100"  />
           {{ $errors->first('password_confirmation')}}
        </div>
      </div>

    </div> <!-- col6 -->
  </div> <!-- row -->
  <hr>
  <div class="form-group row">
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
          password_confirmation: {
            equalTo: "#password"
          },
          password: {
            minlength: 6,
            required: true
          },
          email: {
            email: true
          }
        },
        messages: {
          password: {
            required: 'กรุณากรอก Password',
            minlength: 'กรุณากรอก Password อย่างน้อย 6 ตัวอักษร'
          },
          password_confirmation: {
            equalTo: 'กรุณากรอก Password ให้ตรงกัน'
          },
            'role_id[]': {
            required: 'กรุณาเลือกสิทธ์เข้าใช้งาน'
          },
          first_name: {
            required: 'กรุณาใส่ชื่อ'
          }

        },
         errorPlacement: function(error, element) {
          if($(element).attr('id') == 'role_id' || $(element).attr('id') == 'department_id'){
            error.insertAfter($(element).next());
            $(element).siblings('.select2').children().children().toggleClass('error-border');
          } else {
            error.insertAfter(element);
          }
          
        }
      });


       
    });
  </script>
@endpush




          