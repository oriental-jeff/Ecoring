<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                <h5>เลือกบริษัทขนส่ง:</h5>
                <select id="logistics_id" name="logistics_id" class="form-control">
                    @foreach ($logistics as $logistic)
                    <option value="{{ $logistic->id }}"
                        {{ $logistic_rate->logistics_id === $logistic->id ? 'selected' : '' }}>
                        {{ $logistic->name_th }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="weight_from">ช่วงน้ำหนัก (กรัม) <span class="text-danger"> * </span>
                    :
                </label>
                <input type="text" class="form-control" id="weight_from" name="weight_from"
                    value="{{ old('weight_from') ?? $logistic_rate->weight_from }}" required="" />
                {{ $errors->first('weight_from') }}
            </div>
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 mt-2 text-center align-center"
                style="position: relative; top: 30px;">
                <label class="col-form-label" for="weight_to">&nbsp;
                </label>
                <div>ถึง</div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="weight_to">&nbsp;
                </label>
                <input type="text" class="form-control" id="weight_to" name="weight_to"
                    value="{{ old('weight_to') ?? $logistic_rate->weight_to }}" required="" />
                {{ $errors->first('weight_to') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="price">ค่าบริการ <span class="text-danger"> * </span> :
                </label>
                <input type="text" class="form-control" id="price" name="price"
                    value="{{ old('price') ?? $logistic_rate->price }}" required="" />
                {{ $errors->first('price') }}
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="start_at">วันที่มีผล <span class="text-danger"> * </span> :
                </label>
                <input type="date" class="form-control" id="start_at" name="start_at"
                    value="{{ old('start_at') ?? $logistic_rate->start_at }}" required="" />
                {{ $errors->first('start_at') }}
            </div>
        </div>

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
