@extends('backend.layouts.header', ['script' => [
    'editor'   => true,
    'dropzone' => true
  ],      
],
[ 'css' => [
    'dropzone'   => true
  ],
]
)
@section('title')
	เพิ่มสินค้า
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
        <h5 class="text-white">แบบฟอร์มข้อมูลสินค้า</h5>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <form class="form-horizontal" method="post" id="form-validate" name="demo-form" enctype="multipart/form-data" action="{{ route('backend.products.store') }}">
          @method('post')
          @include('backend.products.form')
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







