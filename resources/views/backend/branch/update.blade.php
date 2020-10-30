@extends('backend.layouts.header')
@section('title')
	แก้ไขสาขา
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
        <h5 class="text-white">ข้อมูลสาขา</h5>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <form class="form-horizontal"  id="form-validate" name="demo-form" enctype="multipart/form-data" action="{{ route('backend.branch.update', ['branch' => $branch->id] ) }}"  method='post'>
            @method('PATCH')
            @include('backend.branch.form')
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





