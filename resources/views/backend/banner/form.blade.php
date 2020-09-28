<style>
    .img-preview {
        max-height: 100px;
        width: auto;
    }
</style>
@if($errors->isNotEmpty())
@dd($errors)
@endif
<div class="row">
    <div class="col-md-12">
        <div class="row mt-2 mr-1">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-3 col-md-12 col-sm-12">
                        <label class='col-form-label w-100' for="end_date">หน้า <span class='text-danger'> * </span> :
                        </label>
                        <select name="page_id" id="page_id" class='form-control select-2' required
                            {{ !empty($banner->id) ? 'disabled' : ""}}>
                            @foreach($pages as $page)

                            <option value="{{ $page->id }}"
                                {{ !empty($banner->page_id) && $banner->page_id == $page->id ? 'selected' : '' }}>
                                {{ $page->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-md-12 col-sm-12">
                        <label class='col-form-label' for="name">ประเภทแบนเนอร์ <span class='text-danger'> * </span> :
                        </label>
                        <select name="type" id="type" class='form-control' required=''
                            {{ !empty($banner->id) ? 'disabled' : ""}}>
                            @foreach($types as $type)
                            <option value="{{ $type }}"
                                {{ !empty($banner->type) && $banner->type == $type ? 'selected' : '' }}>{{ $type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-md-12 col-sm-12">
                        <label class='col-form-label' for="position">ตำแหน่งแบนเนอร์ <span class='text-danger'> *
                            </span> : </label>
                        <select name="position" id="position" class='form-control' required
                            {{ !empty($banner->id) ? 'disabled' : ""}}>
                            @foreach($positions as $position)

                            <option value="{{ $position }}"
                                {{ !empty($banner->position) && $banner->position == $position ? 'selected' : '' }}>
                                {{ $position}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 mr-1">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-6 col-md-12 col-sm-12">
                        <label class='col-form-label' for="name">ชื่อแบนเนอร์ <span class='text-danger'> * </span> :
                        </label>
                        <input type="text" class="form-control " id="name" name="name"
                            value="{{  old('name') ?? $banner->name }}" required="" />
                        {{ $errors->first('name') }}
                    </div>
                </div>
            </div>
        </div>

        @if(empty($banner->id))
        <div class="row static mt-3 mr-1">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row form-silde">
                                    <div class="col-xl-3 col-md-12 col-sm-12">
                                        <label class='col-form-label' for="static_type">ประเภท <span
                                                class="text-danger"> * </span> : </label>
                                        <select name="static_type" id="static_type" class='form-control slide_type'
                                            required>
                                            <option value="image">image</option>
                                            {{-- <option value="video" >video</option> --}}
                                            <option value="youtube">youtube</option>
                                        </select>
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12">
                                        <label class="col-form-label" for="static_type">Link <span class="text-danger">
                                                * </span> : </label>
                                        <input type="text" name="static_url" class="form-control mt-2">
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label " for="image">รูป Pc<span class="text-danger"> *
                                            </span> : </label>
                                        <input type="file" name="static_upload_pc" class="image form-control mt-2">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label " for="image">รูป Mobile<span class="text-danger">
                                                * </span> : </label>
                                        <input type="file" name="static_upload_mobile" class="image form-control mt-2">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-3 mr-1 dynamic" style='display: none;'>
            <div class="col-md-12">
                <div class="row">
                    <button class='btn btn-success add-slide ml-2'> <i class='fas fa-plus'></i>
                        เพิ่มสไลด์แบนเนอร์</button>
                </div>
            </div>
        </div>


        <div class="row mt-3  mr-1 dynamic " style='display: none;'>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row form-silde">
                                    <div class='mt-2 mr-2'>
                                        <!-- {{-- <a href="#" class="slide-delete btn btn-white"><i class='fas fa-tresh text-danger'></i></a> --}} -->
                                    </div>
                                    <div class="col-xl-2 col-md-12 col-sm-12">
                                        <label class='col-form-label' for="slide_type">รูปแบบแบนเนอร์ <span
                                                class='text-danger'> * </span> : </label>
                                        <select name="slide_type[]" class='form-control slide_type' required>
                                            <option value="image">image</option>
                                            {{-- <option value="video">video</option> --}}
                                            <option value="youtube">youtube</option>
                                        </select>
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12 side-url">
                                        <label class='col-form-label ' for="static_type">Link <span class='text-danger'>
                                                * </span> : </label>
                                        <input type="text" name='slide_url[]' class='slide_url form-control mt-2'>
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label " for="slide_upload_pc">รูป PC <span
                                                class="text-danger"> * </span> : </label>
                                        <input type="file" name="slide_upload_pc[]"
                                            class="slide_upload_pc form-control mt-2">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                    </div>
                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label " for="slide_upload_mobile">รูป Mobile <span
                                                class="text-danger"> * </span> : </label>
                                        <input type="file" name="slide_upload_mobile[]"
                                            class="slide_upload_mobile form-control mt-2">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="return-slide"></div>
                    </div>
                </div>
            </div>
        </div>
        @else


        @if($banner->type == 'slide')
        @php
        $slide = 'show';
        $static = 'hide';
        @endphp
        @else
        @php
        $slide = 'hide';
        $static = 'show';
        @endphp
        @endif

        @if($banner->type == 'static')
        @foreach($banner->banners_detail as $key => $banner_detail)
        {{-- static type --}}
        <div class="row edit-static mt-3  mr-1 {{$static}}">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row form-silde">
                                    <div class="col-xl-2 col-md-12 col-sm-12">
                                        <input type="hidden" name='id' value='{{ $banner_detail->id}}'>
                                        <label class='col-form-label' for="static_type">ประเภท <span
                                                class='text-danger'> * </span> : </label>
                                        <select name="edit_type" id="static_type" class='form-control slide_type'
                                            required>
                                            <option value="image" {{$banner_detail->type == 'image' ? 'selected' : ''}}>
                                                image</option>
                                            {{-- <option value="video" {{$banner_detail->type == 'video' ? 'selected' : ''}}>video
                                            </option> --}}
                                            <option value="youtube"
                                                {{$banner_detail->type == 'youtube' ? 'selected' : ''}}>youtube</option>
                                        </select>
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12">
                                        <label class='col-form-label' for="static_type">Link <span class='text-danger'>
                                                * </span> : </label>
                                        <input type="text" name='edit_url' class=' form-control mt-2'
                                            value="{{$banner_detail->url}}">
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label" for="image">รูป Pc<span class="text-danger"> *
                                            </span> : </label>
                                        <input type="file" id='{{$banner_detail->id}}' name="edit_upload_pc"
                                            class="image form-control mt-2">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{$banner_detail->slide_banner_pc}}"
                                                class="img-thumbnail m-4 img-preview"
                                                id='preview-{{$banner_detail->id}}'>
                                        </div>
                                    </div>


                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label" for="image">รูป Mobile<span class="text-danger"> *
                                            </span> : </label>
                                        <input type="file" id='{{$banner_detail->id}}' name="edit_upload_mobile"
                                            class="image_mobile form-control mt-2">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{$banner_detail->slide_banner_mobile}}"
                                                class="img-thumbnail m-4 img-preview"
                                                id='preview-mobile-{{$banner_detail->id}}'>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        {{-- silde type --}}
        <div class="row mt-3  mr-1 edit-dynamic {{$slide}}">
            <div class="col-md-12">
                <div class="row">
                    <button class='btn btn-success add-slide ml-2'> <i class='fas fa-plus'></i>
                        เพิ่มสไลด์แบนเนอร์</button>
                </div>
            </div>
        </div>


        {{-- silde type --}}
        <div class="row mt-3  mr-1 edit-dynamic {{$slide}}">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        @foreach($banner->banners_detail as $key => $banner_detail)
                        <div class="card border">
                            <div class="card-body">
                                <div class="row form-silde">
                                    <div class='mt-2 mr-2'>
                                        <a href="#" class="slide-delete btn btn-white"><i
                                                class='fas fa-trash text-danger'></i></a>
                                    </div>
                                    <input type="hidden" name='id[]' value='{{ $banner_detail->id}}'>
                                    <div class="col-xl-2 col-md-12 col-sm-12">
                                        <label class='col-form-label' for="slide_type">รูปแบบแบนเนอร์ <span
                                                class='text-danger'> * </span> : </label>
                                        <select name="edit_type[]" class='form-control slide_type edit' id='{{$key}}'
                                            required>
                                            <option value="image" {{$banner_detail->type == 'image' ? 'selected' : ''}}>
                                                image</option>
                                            <option value="video" {{$banner_detail->type == 'video' ? 'selected' : ''}}>
                                                video</option>
                                            <option value="youtube"
                                                {{$banner_detail->type == 'youtube' ? 'selected' : ''}}>youtube</option>
                                        </select>
                                    </div>

                                    <div class="col-xl-3 col-md-12 col-sm-12 side-url">
                                        <label class='col-form-label ' for="static_type">Link <span class='text-danger'>
                                                * </span> : </label>
                                        <input type="text" name='edit_url[]' class='slide_url form-control mt-2'
                                            value='{{$banner_detail->url}}'>
                                    </div>

                                    @if($banner_detail->type == 'image')
                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label " for="edit_slide_upload">รูป PC <span
                                                class="text-danger"> * </span> : </label>
                                        <input type="file" id='{{$banner_detail->id}}' name="edit_upload_pc[{{$key}}]"
                                            class="edit_slide_upload form-control mt-2 image">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{$banner_detail->slide_banner_pc}}"
                                                class="img-thumbnail m-4 img-preview"
                                                id='preview-{{$banner_detail->id}}'>
                                        </div>

                                    </div>


                                    <div class="col-xl-3 col-md-12 col-sm-12 slide-pic">
                                        <label class="col-form-label " for="edit_slide_upload">รูป Mobile <span
                                                class="text-danger"> * </span> : </label>
                                        <input type="file" id='{{$banner_detail->id}}'
                                            name="edit_upload_mobile[{{$key}}]"
                                            class="edit_slide_upload form-control mt-4 image_mobile">
                                        <label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{$banner_detail->slide_banner_mobile}}"
                                                class="img-thumbnail m-4 img-preview"
                                                id='preview-mobile-{{$banner_detail->id}}'>
                                        </div>
                                    </div>


                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="return-slide"></div>
                    </div>
                </div>
            </div>
        </div>

        @endif {{-- check type --}}

        @endif {{-- check Create or Update --}}

    </div> <!-- col6 -->
</div> <!-- row -->
<hr>
<div class="form-group row mt-2">
    <div class="col-12 text-left">
        <button type="submit" class="btn btn-white"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i> ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>

@php
$action = request()->route()->getActionMethod();
@endphp
@push('after-scripts')
<script>
    $(function(){
    var action = '{!! $action !!}';
    $('#form-validate').validate({

      errorPlacement: function(error, element) {
        if($(element).attr('id') == 'image'){
          error.insertAfter($(element).parent());
          $(element).siblings('.custom-file-label').toggleClass('error-border');
        } else {
          error.insertAfter(element);
        }

      }
    });

    $('#page_id').select2();

    $('.image').on('change', function(){
      var id = $(this).attr('id');
     readURL(this, "preview-"+id);
    });

    $('.image_mobile').on('change', function(){
      var id = $(this).attr('id');
     readURL(this, "preview-mobile-"+id);
    });

    $('#type').on('change', function(){
      if(action == 'create') {
        if($(this).val() == 'static') {
        $('.static').show();
        $('.dynamic').hide();
      } else {
        $('.static').hide();
        $('.dynamic').show();
      }
    } else {
       if($(this).val() == 'static') {
        $('.edit-static').removeClass('hide');
        $('.edit-static').show();
        $('.edit-dynamic').hide();
      } else {
         $('.edit-dynamic').removeClass('hide');
        $('.edit-static').hide();
        $('.edit-dynamic').show();
      }
    }


    });

    $('.add-slide').on('click', function(e){
      e.preventDefault();
      var form_slide =
          '<div class="card border">'+
             '<div class="card-body">'+
               '<div class="row form-silde">'+
                  '<div class="mt-2 mr-2">'+
                    '<a href="#" class="slide-delete btn btn-white"><i class="fas fa-trash text-danger"></i></a>'+
                  '</div>'+
                 '<div class="col-xl-2 col-md-12 col-sm-12">'+
                  '<label class="col-form-label" for="slide_type">รูปแบบแบนเนอร์ <span class="text-danger"> * </span> :  </label>'+
                  '<select name="slide_type[]"  class="form-control slide_type"  required>'+
                      '<option value="image" >image</option>'+
                      // '<option value="video" >video</option>'+
                      '<option value="youtube" >youtube</option>'+
                  '</select>'+
                '</div>'+
                 '<div class="col-xl-3 col-md-12 col-sm-12 side-url">'+
                  '<label class="col-form-label" for="static_type">Link <span class="text-danger"> * </span> :  </label>'+
                  '<input type="text" name="slide_url[]" class="slide_url form-control mt-2" >'+
                '</div>'+

                '<div class="col-xl-3 col-md-12 col-sm-12 slide-pic">'+
                    '<label class="col-form-label " for="slide_upload_pc">รูป PC <span class="text-danger"> * </span> :  </label>'+
                    '<input type="file" name="slide_upload_pc[]" class="slide_upload_pc form-control mt-2" >'+
                    '<label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>'+
                  '</div>'+
                 '<div class="col-xl-3 col-md-12 col-sm-12 slide-pic">'+
                    '<label class="col-form-label " for="slide_upload_mobile">รูป Mobile <span class="text-danger"> * </span> :  </label>'+
                    '<input type="file" name="slide_upload_mobile[]" class="slide_upload_mobile form-control mt-2" >'+
                    '<label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>'+
                  '</div>'+
                '</div>'+
               '</div>'+
             '</div>'+
           '</div>'
       $('.return-slide').append(form_slide);

    });

    $(document).on('change','.slide_type', function() {
      var _this = $(this);

      if(_this.val() == 'video') {
        _this.parent().siblings('.slide-pic').remove();
        if(action != 'create' && _this.hasClass('edit')) {
          var key = _this.attr('id');
          var upload_name_pc = 'edit_upload_pc['+key+']';
        } else {
           var upload_name_pc = 'slide_upload_pc[]';
        }
        const upload = '<div class="col-xl-3 col-md-12 col-sm-12 slide-pic">'+
                  '<label class="col-form-label " for="slide_upload">ไฟล์วีดิโอ <span class="text-danger"> * </span> :  </label>'+
                  '<input type="file" name="'+upload_name_pc+'" class="slide_upload form-control mt-2" >'+
                '</div>';
        _this.parent().parent('.form-silde').append(upload);

      } else if (_this.val() == 'image') {
        _this.parent().siblings('.slide-pic').remove();
        if(action != 'create' && _this.hasClass('edit')) {
          var key = _this.attr('id');
          var upload_name_pc = 'edit_upload_pc['+key+']';
          var upload_name_mobile = 'edit_upload_mobile['+key+']';
        } else {
           var upload_name_pc = 'slide_upload_pc[]';
           var upload_name_mobile = 'slide_upload_mobile[]';
        }
        const upload = '<div class="col-xl-3 col-md-12 col-sm-12 slide-pic">'+
                  '<label class="col-form-label " for="slide_upload">รูป PC <span class="text-danger"> * </span> :  </label>'+
                  '<input type="file" name="'+upload_name_pc+'" class="slide_upload form-control mt-2" >'+
                  '<label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>'+
                '</div>'+
                '<div class="col-xl-3 col-md-12 col-sm-12 slide-pic">'+
                  '<label class="col-form-label " for="slide_upload">รูป Mobile <span class="text-danger"> * </span> :  </label>'+
                  '<input type="file" name="'+upload_name_mobile+'" class="slide_upload form-control mt-2" >'+
                  '<label class="text-pic">ขนาดภาพที่แนะนำ 1920x768 (ขนาดไม่เกิน 5 MB)</label>'+
                '</div>';

        _this.parent().parent('.form-silde').append(upload);

      } else {
        _this.parent().siblings('.slide-pic').remove();
      }
    });

    $(document).on('click','.slide-delete', function(e) {
      e.preventDefault();
      $(this).parent().parent().parent().parent().remove();
    });



  });
</script>
@endpush
