@if (request()->route()->getActionMethod() == 'create')
<div class="form-row">
    <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
        <h5>เลือกที่จัดเก็บ:</h5>
        <select id="warehouses_id" name="warehouses_id" class="form-control">
            @foreach ($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}" {{ $product->warehouses_id === $warehouse->id ? 'selected' : '' }}>
                {{ $warehouse->name }}</option>
            @endforeach
            <option value="">ยังไม่เลือก</option>
        </select>
    </div>
</div>
@endif
<div class="form-row">
    <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
        <label class="col-form-label" for="sku">SKU : </label>
        <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') ?? $product->sku }}" />
        {{ $errors->first('sku') }}
    </div>
    <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
        <h5>เลือกหมวดหมู่:</h5>
        <select id="categories_id" name="categories_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $product->categories_id === $category->id ? 'selected' : '' }}>
                {{ $category->name_th }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
        <h5>เกรดสินค้า:</h5>
        <select id="grades_id" name="grades_id" class="form-control">
            @foreach ($grades as $grade)
            <option value="{{ $grade->id }}" {{ $product->grades_id === $grade->id ? 'selected' : '' }}>
                {{ $grade->name_th }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <label class="col-form-label" for="name_th">ชื่อเรียก (ไทย) <span class="text-danger"> * </span> : </label>
        <input type="text" class="form-control" id="name_th" name="name_th"
            value="{{ old('name_th') ?? $product->name_th }}" required="" />
        {{ $errors->first('name_th') }}
    </div>
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <label class="col-form-label" for="name_en">ชื่อเรียก (อังกฤษ) <span class="text-danger"> * </span> : </label>
        <input type="text" class="form-control" id="name_en" name="name_en"
            value="{{ old('name_en') ?? $product->name_en }}" required="" />
        {{ $errors->first('name_en') }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <label class="">รูป <span class="text-danger">*</span> :</label>
        <div class="icon">
            <div class="uploaded_image">
                <img id="preview_image" src="{{ $product->image ?? '' }}" class="img-icon" data-toggle="popover"
                    data-html="true" />
            </div>
        </div>
        <div class="custom-file">
            <input type="file" class="image" id="image" name="image"
                {{request()->route()->getActionMethod() == 'create' ? 'required' : ''}}>
            <label class="custom-file-label" for="image">เลือกรูป</label>
        </div>
        <label class='text-pic'>ขนาดภาพที่แนะนำ 500 x 350 (ขนาดไม่เกิน 200 KB)</label>
        {{ $errors->first('image') }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
        <label class="" for="description_th">รายละเอียดสินค้า (ไทย) : </label>
        <textarea name="description_th" class="form-control" id="description_th" name="description_th"
            rows="2">{{  old('description_th') ?? $product->description_th }}</textarea>
        {{ $errors->first('description_th') }}
    </div>

    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
        <label class="" for="description_en">รายละเอียดสินค้า (อังกฤษ) : </label>
        <textarea name="description_en" class="form-control" id="description_en" name="description_en"
            rows="2">{{  old('description_en') ?? $product->description_en }}</textarea>
        {{ $errors->first('description_en') }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
        <label class="" for="info_th">ข้อมูลสินค้า (ไทย) : </label>
        <textarea name="info_th" class="form-control" id="info_th" name="info_th"
            rows="2">{{  old('info_th') ?? $product->info_th }}</textarea>
        {{ $errors->first('info_th') }}
    </div>

    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
        <label class="" for="info_en">ข้อมูลสินค้า (อังกฤษ) : </label>
        <textarea name="info_en" class="form-control" id="info_en" name="info_en"
            rows="2">{{  old('info_en') ?? $product->info_en }}</textarea>
        {{ $errors->first('info_en') }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <label class="col-form-label" for="full_price"
            style="-webkit-text-decoration-line: line-through; text-decoration-line: line-through;">ราคาเต็ม <span
                class="text-danger"> * </span> : </label>
        <input type="number" step="any" class="form-control" id="full_price" name="full_price"
            value="{{ old('full_price') ?? $product->full_price }}" required="" />
        {{ $errors->first('full_price') }}
    </div>
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <label class="col-form-label" for="price">ราคา <span class="text-danger"> * </span> : </label>
        <input type="number" step="any" class="form-control" id="price" name="price"
            value="{{ old('price') ?? $product->price }}" required="" />
        {{ $errors->first('price') }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <label class="col-form-label" for="weight">น้ำหนัก <span class="text-danger"> * </span> : </label>
        <input type="number" step="any" class="form-control" id="weight" name="weight"
            value="{{ old('weight') ?? $product->weight }}" required="" />
        {{ $errors->first('weight') }}
    </div>
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <div class="form-check" style="margin-top: 25px;">
            <input type="checkbox" class="form-check-input" id="recommend" name="recommend" value="1"
                {{ (old('recommend') == 'Recommend' OR $product->recommend == 'Recommend') ? 'checked' : '' }}>
            <label class="form-check-label" for="recommend">แสดงเป็นสินค้าแนะนำ </label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-6 col-md-12 col-lg-6">
        <label class="col-form-label" style='width: 100%;'>สถานะการใช้งาน:</label>
        <div class="radio radio-css radio-inline">
            <input class="form-check-input" type="radio" name="active" id="active1" value="1"
                {{ (old('active') == 'Active' OR $product->active == 'Active') ? 'checked' : '' }}>
            <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
        </div>
        <div class="radio radio-css radio-inline">
            <input class="form-check-input" type="radio" name="active" id="active2" value="0"
                {{ (old('active') == 'Inactive' OR $product->active == 'Inactive') ? 'checked' : '' }}>
            <label class="form-check-label ml-2" for="active2">ปิดใช้งาน</label>
        </div>
    </div>
</div>
</div>
<hr>
<div class="form-row mt-2">
    <div class="form-group col-12 text-left">
        <button type="submit" class="btn btn-white"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i> ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>

@push('after-scripts')
<script>
    $('#image').change(function() {
        $('#image').removeData('imageWidth');
        $('#image').removeData('imageHeight');
        var file = this.files[0];
        var tmpImg = new Image();
        tmpImg.src=window.URL.createObjectURL( file );
        tmpImg.onload = function() {
        width = tmpImg.naturalWidth,
        height = tmpImg.naturalHeight;
        $('#image').data('imageWidth', width);
        $('#image').data('imageHeight', height);
        }
    });

    $.validator.addMethod('ImageMaxWidth', function(value, element, maxWidth) {
        if(element.files.length == 0){
        return true; // check here if file not added than return true for not check file dimention
        }
        var width = $(element).data('imageWidth');
        if(width <= maxWidth){
        return true;
        }else{
        return false;
        }
    });

    $(function(){
        $('#form-validate').validate({
            rules: {
                image: {
                    ImageMaxWidth: 500 //image max width 500 px
                }
            },
            messages: {
                image: {
                    ImageMaxWidth: "ความกว้างของรูปไม่เกิน 500 pixels"
                }
            },
            errorPlacement: function(error, element) {
                if($(element).attr('id') == 'image'){
                    error.insertAfter($(element).parent());
                    $(element).siblings('.custom-file-label').toggleClass('error-border');
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $('#image').on('change', function(){
            readURL(this, "preview_image");
        });

        $('.text-count-150').characterCounter({
            minlength: 0,
            maxlength: 150,
            blockextra: true,
            position: 'top',
        });

        // CKEDITOR
        CKEDITOR.replace('description_th', {
            filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('description_en', {
            filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('info_th', {
            filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('info_en', {
            filebrowserUploadUrl: "{{route('backend.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    });
</script>
@endpush
