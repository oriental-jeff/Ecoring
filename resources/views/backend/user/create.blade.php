@extends('backend.layouts.header')
@section('title')
	เพิ่มผู้ใช้งาน
@endsection
@section('content')

<!-- begin row -->
<div class="row">
  <!-- begin col-6 -->
  <div class="col-lg-12">
    <!-- begin panel -->
    <div class="panel " data-sortable-id="form-validation-1">
      <!-- begin panel-heading -->
      <div class="panel-heading panel-black">
        <h5 class="text-white">ข้อมูลผู้ใช้งาน</h5>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <form class="form-horizontal" method="post"  id="form-validate" name="demo-form" enctype="multipart/form-data" action="{{ route('backend.user.store') }}" >
          @method('post')
          @include('backend.user.form')
          @csrf

        </form>  
      </div>
      <!-- end panel-body -->
    </div>
    <!-- end panel -->
  </div>
  <!-- end col-6 -->
</div>
<!-- end row -->

@endsection

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

