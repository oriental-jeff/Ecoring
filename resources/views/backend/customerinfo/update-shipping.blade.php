@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])

<style>
    .panel-heading { letter-spacing: 1px; }
    .form-title { color: darkblue; letter-spacing: 1px; }
    .control-label { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; padding-top: 0 !important; }
    .control-label-answer { font-size: 14px; color: darkblue; font-weight: bold; letter-spacing: 1px; }
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

{{-- Modal --}}
<div id="modal-edit-shipping" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="card-title font-weight-bold"></h4>
            </div>

            <div class="modal-body">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-outline-danger" data-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>

{{-- Hidden --}}
{{-- <input type="hidden" id="address_province_id" value="{{ $user->profiles->province_id }}">
<input type="hidden" id="address_district_id" value="{{ $user->profiles->district_id }}">
<input type="hidden" id="address_subdistrict_id" value="{{ $user->profiles->sub_district_id }}"> --}}
@endsection

@push('after-scripts')
<script>
    function removeShipping(shipping_id) {
        $.ajax({
            url: '/backend/customerinfo/remove_shipping_address',
            data: {shipping_id: shipping_id},
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                // console.log(res);
                if (res == 1) {
                    swal({
                        title: 'ที่อยู่จัดส่งถูกลบออกแล้ว',
                        icon: 'success',
                        buttons: {
                            confirm: {
                                text: 'รับทราบ',
                                value: true,
                                visible: true,
                                className: 'btn btn-success',
                                closeModal: true
                            }
                        }
                    }).then(function(value) {
                        if (value == true) {
                            $('#shipping-data-' + shipping_id).fadeOut(1200);
                            $('#shipping-data-' + shipping_id).next().fadeOut(1200);
                        }
                    });
                }
            },
            error: function(err) { console.error(err); }
        });
    }

    function back() {
        window.location.href = '/backend/customerinfo';
    }

    $(document).ready(function() {});
</script>
@endpush
