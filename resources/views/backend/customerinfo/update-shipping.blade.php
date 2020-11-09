@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])

<style>
    .panel-heading { letter-spacing: 1px; }
    .form-title { color: darkblue; letter-spacing: 1px; }
    .control-label { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; }
    .control-label-error { font-size: 16px; color: red; font-weight: bold; letter-spacing: 2px; }
    .btn { font-size: 16px !important; letter-spacing: 1px; }
</style>

@section('title')
<i class="fad fa-lg fa-user"></i> แก้ไขที่อยู่จัดส่ง : {{ $addresses->first_name }} {{ $addresses->last_name }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="panel" data-sortable-id="form-validation-1">
            <div class="panel-body">
                <form class="form-horizontal" id="form-validate" name="demo-form" enctype="multipart/form-data"
                    action="{{ route('backend.customerinfo.process_update_shipping') }}" method='post'>
                    @method('PATCH')
                    @csrf
                    @include('backend.customerinfo.form-update-shipping')
                </form>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
</div>
<!-- end row -->

{{-- Hidden --}}
{{-- <input type="hidden" id="address_province_id" value="{{ $user->profiles->province_id }}">
<input type="hidden" id="address_district_id" value="{{ $user->profiles->district_id }}">
<input type="hidden" id="address_subdistrict_id" value="{{ $user->profiles->sub_district_id }}"> --}}
@endsection

@push('after-scripts')
<script>
    function back() {
        window.location.href = '/backend/customerinfo';
    }

    function ddlShowDistrict(province_id) {
        let option = '';
        let selected = '';
        let address_district_id = $('#address_district_id').val();

        $.ajax({
            url: '/backend/customerinfo/get_districts_from_province',
            type: 'GET',
            data: {province_id: province_id},
            dataType: 'json',
            success: function(res) {
                $('#district').empty();
                if (res != null) {
                    $.each(res, function(key, val) {
                        selected = (val.id == address_district_id) ? 'selected' : '';
                        option = '<option value="' + val.id + '" ' + selected + '>' + val.name_th + '</option>';
                        $('#district').append(option);
                    });
                } else {
                    option = '<option value="">-- เลือก --</option>';
                    $('#district').append(option);
                }
            },
            error: function(err) { console.error(err); }
        });
    }

    function ddlShowSubDistrict(district_id) {
        let option = '';
        let selected = '';
        let address_subdistrict_id = $('#address_subdistrict_id').val();

        $.ajax({
            url: '/backend/customerinfo/get_subdistricts_from_district',
            type: 'GET',
            data: {district_id: district_id},
            dataType: 'json',
            success: function(res) {
                $('#sub-district, #postcode').empty();
                // $('#postcode').val(val.zipcode);
                if (res != null) {
                    $.each(res, function(key, val) {
                        selected = (val.id == address_subdistrict_id) ? 'selected' : '';
                        option = '<option value="' + val.id + '" ' + selected + '>' + val.name_th + '</option>';
                        $('#postcode').val(val.zip_code);
                        $('#sub-district').append(option);
                    });
                } else {
                    option = '<option value="">-- เลือก --</option>';
                    $('#sub-district').append(option);
                    $('#postcode').val('');
                }
            },
            error: function(err) { console.error(err); }
        });
    }

    $(document).ready(function() {
        // On Loaded Page
        let address_province_id = $('#address_province_id').val();
        let address_district_id = $('#address_district_id').val();
        let address_subdistrict_id = $('#address_subdistrict_id').val();

        if (address_province_id != '') {
            ddlShowDistrict(address_province_id);
        }

        if (address_district_id != '') {
            ddlShowSubDistrict(address_district_id);
        }
        // --------------------------------------------------

        // On Change Province
        $(document).on('change', '#province', function() {
            let province_id = $(this).val();
            $('#sub-district').empty();
            ddlShowDistrict(province_id);
        });

        // On Change District
        $(document).on('change', '#district', function() {
            let district_id = $(this).val();
            ddlShowSubDistrict(district_id);
        });
    });
</script>
@endpush
