@extends('backend.layouts.header')
@section('title')
แก้ไขโปรโมชั่น
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
                <h5 class="text-white">แบบฟอร์มข้อมูลโปรโมชั่น</h5>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <form class="form-horizontal" id="form-validate" name="demo-form" enctype="multipart/form-data"
                    action="{{ route('backend.promotions.update', ['promotion' => $promotion->id] ) }}" method='post'>
                    @method('PATCH')
                    @include('backend.promotions.form')
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
