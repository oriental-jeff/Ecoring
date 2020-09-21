<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                <h5>เลือกบริษัทขนส่ง <span class="text-danger"> * </span>:</h5>
                <select id="logistics_id" name="logistics_id" class="form-control" required>
                    @foreach ($logistics as $logistic)
                    <option value="{{ $logistic->id }}"
                        {{ $logistic_rate->logistics_id === $logistic->id ? 'selected' : '' }}>
                        {{ $logistic->name_th }}</option>
                    @endforeach
                </select>
                {{ $errors->first('name_th') }}
            </div>
        </div>
        <div class="row weightRange">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="weight_from">ช่วงน้ำหนัก (กรัม) <span class="text-danger"> * </span>
                    :
                </label>
                <input type="number" min="0" max="999" step="any" class="chkRange form-control" id="weight_from"
                    name="weight_from" value="{{ old('weight_from') ?? $logistic_rate->weight_from }}" required="" />
                {{ $errors->first('weight_from') }}
            </div>
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 mt-2 text-center align-center"
                style="position: relative; top: 30px;">
                <label class="col-form-label" for="weight_to">&nbsp;
                </label>
                <div>ถึง</div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="weight_to">&nbsp;
                </label>
                <input type="number" min="0" max="999" step="any" class="chkRange form-control" id="weight_to"
                    name="weight_to" value="{{ old('weight_to') ?? $logistic_rate->weight_to }}" required="" />
                {{ $errors->first('weight_to') }}
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mt-2" style="position: relative; top: 30px;">
                <span class="weightRangeErr"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="price">ค่าบริการ <span class="text-danger"> * </span> :
                </label>
                <input type="number" min="0" step="any" class="form-control" id="price" name="price"
                    value="{{ old('price') ?? $logistic_rate->price }}" required="" />
                {{ $errors->first('price') }}
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="start_at">วันที่เริ่ม <span class="text-danger"> * </span> :
                </label>
                <input type="date" class="form-control datepicker-startdate valid" id="start_at" name="start_at"
                    value="{{ old('start_at') ?? $logistic_rate->start_at }}" required="" />
                {{ $errors->first('start_at') }}
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label" for="end_at">วันที่สิ้นสุด (ปล่อยว่างหากไม่ต้องการกำหนด) :
                </label>
                <input type="date" class="form-control datepicker-enddate valid" id="end_at" name="end_at"
                    value="{{ old('end_at') ?? $logistic_rate->end_at }}" />
                {{ $errors->first('end_at') }}
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

@push('after-scripts')
<script>
    $(function() {
        // Compare Weight
        $('.chkRange').on('change', function() {
            $('.weightRangeErr').html('');
            if ($(this).attr('name') === 'weight_from') {
                if (parseInt($(this).val()) > parseInt($('#weight_to').val())) $('.weightRangeErr').html('\
                    <div class="alert alert-warning" role="alert">\
                    * ค่าทางด้านซ้ายต้องน้อยกว่า หรือ เท่ากับ ค่าทางด้านขวา\
                    </div>');
            } else {
                if (parseInt($(this).val()) < parseInt($('#weight_from').val())) $('.weightRangeErr').html('\
                    <div class="alert alert-warning" role="alert">\
                    * ค่าทางด้านขวาต้องมากกว่า หรือ เท่ากับ ค่าทางด้านซ้าย\
                    </div>');
            }
        });
        $('#form-validate').on('submit', function() {
            if ($('.weightRangeErr').html() !== "") return false;
        })
    });
</script>
@endpush
