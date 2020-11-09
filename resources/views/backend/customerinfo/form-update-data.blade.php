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

<h3 class="form-title">ข้อมูลส่วนตัว</h3>
<div class="form-group" id="personal-data">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="first_name">
                    <span class="text-danger">*</span> ชื่อ :
                </label>
                <input type="text" class="form-control text-left col-md-8" id="first_name" name="first_name"
                    value="{{ old('first_name') ?? $user->first_name }}" required autofocus>
                {{ $errors->first('first_name') }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="last_name">
                    <span class="text-danger">*</span> นามสกุล :
                </label>
                <input type="text" class="form-control text-left col-md-8" id="last_name" name="last_name"
                    value="{{ old('last_name') ?? $user->last_name }}" required>
                {{ $errors->first('last_name') }}
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="email">
                    <span class="text-danger">*</span> อีเมล์ :
                </label>
                <input type="text" class="form-control text-left col-md-8" id="email" name="email"
                    value="{{ old('email') ?? $user->email }}" required>
                {{ $errors->first('email') }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="telephone">
                    <span class="text-danger">*</span> เบอร์โทร :
                </label>
                <input type="text" class="form-control text-left col-md-8" id="telephone" name="telephone"
                    value="{{ old('telephone') ?? $user->profiles->telephone }}" required>
                {{ $errors->first('telephone') }}
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="birthday">
                    <span class="text-danger">*</span> วันเกิด :
                </label>
                <input type="date" class="form-control text-left col-md-8" id="birthdate" name="birthday"
                    value="{{ old('birthday') ?? $user->profiles->birthday }}" required>
                {{ $errors->first('birthday') }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="telephone">เพศ :</label>
                <input type="text" class="form-control text-left col-md-8"
                    value="{{ $user->profiles->sex == 1 ? 'ชาย' : 'หญิง' }}" readonly>
            </div>
        </div>
    </div>
</div>
{{-- END : form-group #personal-data --}}

<hr class="my-3">

<h3 class="form-title">ที่อยู่</h3>
<div class="form-group" id="address-data">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label class="control-label text-right col-md-3" for="address">
                    <span class="text-danger">*</span> ที่อยู่ :
                </label>
                <textarea name="address" id="address" rows="4" class="form-control text-left col-md-9" required>{{ old('address') ??$user->profiles->address }}</textarea>
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
                    @foreach ($provinces as $key => $province)
                        <option value="{{ $province->id }}" {{ $province->id == $user->profiles->province_id ? 'selected' : '' }}>
                            {{ $province->name_th }}
                        </option>
                    @endforeach
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
                    value="{{ old('postcode') ?? $user->profiles->postcode }}" required>
                {{ $errors->first('postcode') }}
            </div>
        </div>
    </div>
</div>
{{-- END : form-group #address-data --}}

<hr class="my-5">

{{-- Buttons Zone --}}
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-left">
            <button type="button" class="btn btn-outline-danger mr-3" onclick="back()">
                <i class="fal fa-lg fa-angle-double-left"></i> ย้อนกลับ
            </button>

            <button type="submit" class="btn btn-success">
                <i class="fal fa-lg fa-user-cog"></i> แก้ไขข้อมูล
            </button>

            <button type="button" class="btn btn-outline-dark mr-3 float-right" onclick="deactivated('{{ $user->id }}')">
                <i class="fal fa-lg fa-power-off"></i> ปิดการใช้งาน
            </button>
        </div>
    </div>
</div>
