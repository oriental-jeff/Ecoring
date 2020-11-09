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

<h3 class="form-title">เปลี่ยนรหัสผ่าน</h3>
<div class="form-group" id="change-password">
    <div class="row row-password">
        <label class="col-md-3 control-label pt-2 text-right" for="new_pass">
            <span class="text-danger">*</span> รหัสผ่านใหม่ :
        </label>
        <input type="password" class="col-md-4 form-control text-left" id="new_pass" name="new_pass" required autofocus>
        {{ $errors->first('new_pass') }}
    </div>

    <div class="row mt-3 row-password">
        <label class="col-md-3 control-label pt-2 text-right" for="confirm_new_pass">
            <span class="text-danger">*</span> ยืนยันรหัสผ่านใหม่ :
        </label>
        <input type="password" class="col-md-4 form-control text-left" id="confirm_new_pass" name="confirm_new_pass" required>
        {{ $errors->first('confirm_new_pass') }}
    </div>
</div>
{{-- END : form-group #change-password --}}

<hr class="my-5">

{{-- Buttons Zone --}}
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-left">
            <button type="button" class="btn btn-outline-danger mr-3" onclick="back()">
                <i class="fal fa-lg fa-angle-double-left"></i> ย้อนกลับ
            </button>

            <button type="submit" class="btn btn-success" id="btn-submit" disabled>
                <i class="fal fa-lg fa-user-cog"></i> แก้ไขรหัสผ่าน
            </button>
        </div>
    </div>
</div>

{{-- Hidden --}}
<input type="hidden" name="user_id" value="{{ $user->id }}">
