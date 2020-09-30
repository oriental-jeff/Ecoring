<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <h5>ข้อมูลสินค้า <span class="text-danger"> * </span>:</h5>
                <select id="products_id" name="products_id" class="form-control"
                    {{ (request()->route()->getActionMethod() == 'create') ? 'required' : 'disabled' }}>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name_th }}</option>
                    @endforeach
                </select>
                {{ $errors->first('name_th') }}
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class='col-form-label ' for="static_type">ราคา <span class='text-danger'>
                        * </span> : </label>
                <input type="number" min="0" step="any" name='price' value="{{ old('price') ?? $product_price->price }}"
                    class='form-control mt-2'>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="start_at">วันที่เริ่ม <span class="text-danger"> * </span> :
                </label>
                <input type="date" class="form-control" id="start_at" name="start_at"
                    value="{{ old('start_at') ?? $product_price->start_at }}" required="" />
                {{ $errors->first('start_at') }}
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">`
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-xl-6 col-md-12 col-lg-6 mt-2">
                <label class="col-form-label" style='width: 100%;'>สถานะการใช้งาน:</label>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1"
                        {{ (old('active') == 'Active' OR $product_price->active == 'Active') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="active1">เปิดใช้งาน</label>
                </div>
                <div class="radio radio-css radio-inline">
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0"
                        {{ (old('active') == 'Inactive' OR $product_price->active == 'Inactive') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="active2">ปิดใช้งาน</label>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-group row mt-2">
    <div class="col-12 text-left">
        <button type="submit" class="btn btn-white"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i> ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>


@push('after-scripts')
<script>
    $(function(){

    });
</script>
@endpush
