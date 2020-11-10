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
<div class="form-group" id="shipping-data-{{ $item->id }}">
    <div class="row">
        <div class="col-md-1">
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-sm btn-outline-dark"
                    onclick="removeShipping('{{ $item->id }}')">ลบที่อยู่</button>
                </div>
            </div>
        </div>

        <div class="col-md-11">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label class="control-label text-right col-md-3">ชื่อ - นามสกุล :</label>
                        <label class="control-label-answer text-left col-md-8">{{ $item->fullname }}</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <label class="control-label text-right col-md-3">เบอร์โทร :</label>
                        <label class="control-label-answer text-left col-md-8">{{ $item->telephone }}</label>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="row">
                        <label class="control-label text-right col-md-3">ที่อยู่ :</label>
                        <label class="control-label-answer text-left col-md-9">
                            {{ $item->address }}
                            เขต{{ $item->districts->name_th }}
                            แขวง{{ $item->sub_districts->name_th }}
                            {{ $item->provinces->name_th }}
                            {{ $item->postcode }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
@endforeach
{{-- END : form-group #shipping-data --}}

{{-- Buttons Zone --}}
<div class="form-group mt-5">
    <div class="row">
        <div class="col-md-12 text-left">
            <button type="button" class="btn btn-outline-danger mr-3" onclick="back()">
                <i class="fal fa-lg fa-angle-double-left"></i> ย้อนกลับ
            </button>
        </div>
    </div>
</div>
