  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class='col-form-label' for="email">Username <span class='text-danger'> * </span> : </label>
          <input type="email"id="email" name="email" value="{{ $user->email ?? old('email') }} " placeholder="" maxlength="100" class='form-control'  {{ !empty($user->id) ? 'readonly' : '' }} required/>
           {{ $errors->first('email')}}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class='col-form-label' for="password">Password <span class='text-danger'> * </span> : </label>
          <input type="password" class="form-control" id="password" name="password" value="{{ old('password') ?? '' }}" placeholder="" />
           {{ $errors->first('password')}}
        </div>
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class='col-form-label' for="password">Confirm Password <span class='text-danger'> * </span> :  </label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{  old('password_confirmation') ?? '' }}"  placeholder="" maxlength="100" />
           {{ $errors->first('password_confirmation')}}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class='col-form-label' for="first_name">ชื่อ <span class='text-danger'> * </span> : </label>
          <input type="text" class="form-control " id="first_name" name="first_name" value="{{ $user->first_name ?? old('first_name') }}" required="" />
          {{ $errors->first('first_name') }}
        </div>
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class='col-form-label' for="last_name">นามสกุล <span class='text-danger'> * </span> : </label>
          <input type="text" class="form-control first_name" id="last_name" name="last_name" value="{{ $user->last_name ?? old('last_name') }}" />
          {{ $errors->first('first_name') }}
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 mt-2">
          <label class='col-form-label' for="end_date">สิทธิ์เข้าใช้งาน <span class='text-danger'> * </span> : </label>
          <select name="role_id[]" id="role_id" class='form-control select-2' multiple="multiple" required>
            @foreach($roles as $role)
              <option value="{{ $role->name }}" >{{ $role->name }}</option>
            @endforeach
          </select>
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
       
@if(!empty($user->roles))
  @php
   $roles = $user->roles->pluck('name')->toJson();
  @endphp
@else
  @php 
  $roles = '';
  @endphp
@endif 
@push('after-scripts')
  <script>
    $(function(){
      var roles = '{!! $roles !!}';
      $('#role_id').select2();
      if(roles != '') {
        $('#role_id').val($.parseJSON(roles)).change();
      }

      $('#department_id').select2();
    });


  </script>
@endpush