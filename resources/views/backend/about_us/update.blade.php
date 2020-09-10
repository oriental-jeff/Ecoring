@extends('backend.layouts.header', 
  ['script' => 
    [
      'editor'   => true
    ],      
  ]
)
@section('title')
	แก้ไขข้อมูลเกี่ยวกับเรา
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
        <h5 class="text-white">ข้อมูลเกี่ยวกับเรา</h5>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <form class="form-horizontal" id="form-validate" name="demo-form" enctype="multipart/form-data" action="{{ route('backend.about.update', ['about' => $about->id] ) }}"  method="post">
            @method('PATCH')
            @include('backend.about_us.form')
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






