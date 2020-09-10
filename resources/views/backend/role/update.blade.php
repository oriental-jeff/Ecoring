@extends('backend.layouts.header', [
                                    'script' => ['treeview' => true],
                                    'css'    => ['treeview' => true],
                                   ]
        );
@section('title')
	แก้ไขสิทธิ์เข้าใช้งาน
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
        <h5 class="text-white">ข้อมูลพนักงาน</h5>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <form class="form-horizontal"  id="" name="demo-form" enctype="multipart/form-data" action="{{ route('backend.role.update', ['role' => $role->id]) }}"  method='post'>
            @method('PATCH')
            @include('backend.role.form')
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


