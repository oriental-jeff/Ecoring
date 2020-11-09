{{-- Alert Errors --}}
<div class="form-group">
    @foreach ($errors->all() as $message)
    <div class="row">
        <div class="col-md-12 text-center">
            <lebel class="control-label-error">{{ $message }}</lebel>
        </div>
    </div>
    @endforeach
</div>

<h3 class="form-title">ที่อยู่จัดส่ง</h3>
@foreach ($addresses->address_deliveries as $key => $item)
<div class="form-group" id="shipping-data">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="fullname">
                    <span class="text-danger">*</span> ชื่อ - นามสกุล :
                </label>
                <input type="text" class="form-control text-left col-md-8" id="fullname" name="fullname"
                    value="{{ old('fullname') ?? $item->fullname }}" required>
                {{ $errors->first('fullname') }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="row mt-3">
                <label class="control-label text-right col-md-3" for="telephone">
                    <span class="text-danger">*</span> เบอร์โทร :
                </label>
                <input type="text" class="form-control text-left col-md-8" id="telephone" name="telephone"
                    value="{{ old('telephone') ?? $item->telephone }}" required>
                {{ $errors->first('telephone') }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="address">
                    <span class="text-danger">*</span> ที่อยู่ :
                </label>
                <textarea name="address" id="address" rows="4" class="form-control text-left col-md-9"
                    required>{{ old('address') ?? $item->address }}</textarea>
                {{ $errors->first('address') }}
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="province_id">
                    <span class="text-danger">*</span> จังหวัด :
                </label>
                <select name="province_id" id="province" class="form-control text-left col-md-8">
                    <option value="">-- เลือก --</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="district_id">
                    <span class="text-danger">*</span> อำเภอ / เขต :
                </label>
                <select name="district_id" id="district" class="form-control text-left col-md-8">
                    <option value="">-- เลือก --</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="sub_district_id">
                    <span class="text-danger">*</span> ตำบล / แขวง :
                </label>
                <select name="sub_district_id" id="sub-district" class="form-control text-left col-md-8">
                    <option value="">-- เลือก --</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="postcode">
                    <span class="text-danger">*</span> รหัสไปรษณีย์ :
                </label>
                <input type="text" class="form-control text-left col-md-8" id="postcode" name="postcode"
                    value="{{ old('postcode') ?? $item->postcode }}" required>
                {{ $errors->first('postcode') }}
            </div>
        </div>
    </div>
</div>

<hr>
@endforeach
{{-- END : form-group #shipping-data --}}

<hr class="my-5">

{{-- Buttons Zone --}}
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-left">
            <button type="button" class="btn btn-outline-danger mr-3" onclick="back()">
                <i class="fal fa-lg fa-angle-double-left"></i> ย้อนกลับ
            </button>

            <button type="submit" class="btn btn-success">
                <i class="fal fa-lg fa-user-cog"></i> บันทึก
            </button>
        </div>
    </div>
</div>
