<div class="row">
  <div class="col-md-6"> 
    <div class="row  mt-2 ">
      <div class="col-xl-12 col-md-12 col-sm-12">
        <label class='col-form-label' for="name">ชื่อสิทธิ์การใช้งาน <span class='text-danger'> * </span> : </label>
        <input type="text" class="form-control " id="name" name="name" value="{{ old('name') ?? $role->name }}"  required="" />
        {{ $errors->first('name') }}
      </div>
    </div>
  </div>

  <div class="col-md-6 border-l">
    <label class=" col-form-label text-left mt-2">สิทธิ์การใช้งาน:</label>
    <div class="permission-tree">
      <ul>
        @foreach ($permissions as $key => $permission_manage) 
          <li class="jstree-open" id="{{$permission_manage['name']}}" 
          data-jstree='{"icon":"fas fa-cog fa-spin text-success"}'
          data-checkstate= 
          @if (!empty($role_permissions) && in_array($permission_manage['name'], $role_permissions))
            {{ 'checked' }}
          @else
            {{ '' }}
          @endif

          > {{ ucwords(str_replace('_', ' ', $permission_manage['name'])) }}
            <ul>       
              @foreach ($permission_manage[$key] as $permission) 
                <li id="{{$permission['name']}}"  class="jstree-closed"
                  data-checkstate= 
                    @if (!empty($role_permissions) && in_array($permission['name'], $role_permissions))
                      {{ 'checked' }}
                    @else
                      {{ '' }}
                    @endif
                >{{Str::of($permission['name'])->ucfirst()}}</li>
              @endforeach
            </ul>
          </li>

          @endforeach
        </ul>
      </div>
      <input type="text" class="border-0 invisible" id="permission" name="permission" value="{{ $role_permission ?? ''}}">
      {{ $errors->first('permission')}}

   </div><!-- col6 -->
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
      $(function() {
        //$('.jstree-open').addClass('jstree-closed').removeClass('jstree-open');
      });
    </script>
  @endpush

  
          