@extends('backend.layouts.header')
@section('title')
  แก้ไขแบนเนอร์
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
        <h5 class="text-white">ข้อมูลแบนเนอร์</h5>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <form class="form-horizontal"  id="form-validate" name="demo-form" enctype="multipart/form-data" action="{{ route('backend.banner.update', ['banner' => $banner->id] ) }}"  method='post'>
          @method('PATCH')
          @include('backend.banner.form')
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

{{-- Clone Template : Add Slide --}}
<div class="d-none">
    <div class="card border" id="slide-content-mockup">
        <div class="card-body">
          <div class="row mb-3">
            <label class="control-label-title mr-3 slide-count" id="slide-count">Slide 1</label>
            <i class="fas fa-2x fa-times-circle text-danger decrease-slide" title="ลบสไลด์นี้"
              onclick="decreaseSlide(this)"></i>
          </div>

          <div class="row form-silde">
            <div class="col-md-4">
              <label class="col-form-label">ตำแหน่งของสไลด์</label>
              <select name="slide_position[]" class="form-control slide-position" required>
                @for ($pos = 1; $pos <= 10; $pos++)
                    <option value="{{ $pos }}">{{ $pos }}</option>
                @endfor
              </select>
            </div>

            <div class="col-md-4">
              <label class='col-form-label' for="slide_type">
                รูปแบบแบนเนอร์ <span class='text-danger'>*</span> :
              </label>
              <select name="slide_type[]" class='form-control slide_type edit' required>
                <option value="image">Image</option>
                <option value="youtube">Youtube
                </option>
              </select>
            </div>

            <div class="col-md-4 side-url">
              <label class='col-form-label ' for="static_type">
                Link <span class='text-danger'>*</span> :
              </label>
              <input type="text" name='url[]' class='slide_url form-control mt-2'>
            </div>
          </div>

          <div class="row form-silde">
            <div class="col-md-6 slide-pic">
              <label class="col-form-label " for="edit_slide_upload">
                รูป PC <span class="text-danger">*</span> :
              </label>
              <input type="file" name="slide_upload_pc[]" class="slide_upload form-control image">
              <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
            </div>

            <div class="col-md-6 slide-pic">
              <label class="col-form-label " for="edit_slide_upload">
                รูป Mobile <span class="text-danger">*</span> :
              </label>
              <input type="file" name="slide_upload_mobile[]" class="slide_upload form-control image_mobile">
              <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection





