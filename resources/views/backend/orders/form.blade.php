@if (session('status'))
<div class="alert alert-warning">
    {{ session('status') }}
</div>
@endif
<div class="form-row">
    <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
        <h5>เลือกที่จัดเก็บ <span class="text-danger"> * </span>:</h5>
        <select id="warehouses_id" name="warehouses_id" class="form-control" required>
            @foreach ($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}" {{ $order->warehouses_id === $warehouse->id ? 'selected' : '' }}>
                {{ $warehouse->name }}</option>
            @endforeach
        </select>
        {{ $errors->first('warehouses_id') }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
        <h5>เลือกสินค้า <span class="text-danger"> * </span>:</h5>
        <select id="products_id" name="products_id" class="form-control" required>
            @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ $order->products_id === $product->id ? 'selected' : '' }}>
                {{ $product->name_th }}</option>
            @endforeach
        </select>
        {{ $errors->first('products_id') }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-xl-2 col-lg-2 col-md-12 col-sm-12 mt-2">
        <label class="col-form-label" for="quantity">ระบุจำนวนคงเหลือ <span class="text-danger"> * </span> : </label>
        <input type="number" class="form-control" id="quantity" name="quantity"
            value="{{ old('quantity') ?? $order->quantity }}" required="" />
        {{ $errors->first('quantity') }}
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
