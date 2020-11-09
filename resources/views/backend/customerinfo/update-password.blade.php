@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])

<style>
    input[type="password"] { font-size: 40px !important; }

    .panel-heading { letter-spacing: 1px; }
    .form-title { color: darkblue; letter-spacing: 1px; }
    .control-label { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; }
    .control-label-error { font-size: 16px; color: red; font-weight: bold; letter-spacing: 2px; }
    .btn { font-size: 16px !important; letter-spacing: 1px; }
</style>

@section('title')
<i class="fad fa-lg fa-key-skeleton"></i> แก้ไขรหัสผ่าน : {{ $user->first_name }} {{ $user->last_name }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="panel" data-sortable-id="form-validation-1">
            <div class="panel-body">
                <form class="form-horizontal" id="form-validate" name="demo-form" enctype="multipart/form-data"
                    action="{{ route('backend.customerinfo.process_update_password') }}" method='post'>
                    @method('POST')
                    @csrf
                    @include('backend.customerinfo.form-update-password')
                </form>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
</div>
<!-- end row -->
@endsection

@push('after-scripts')
<script>
    function back() {
        window.location.href = '/backend/customerinfo';
    }

    $(document).ready(function() {

        $(document).on('keyup', '#confirm_new_pass', function() {
            let new_pass = $('#new_pass').val();
            let con_new_pass = $(this).val();

            if (new_pass === con_new_pass) {
                $('.row-password').addClass('has-success').removeClass('has-error');
                $('#btn-submit').prop('disabled', false);
            } else {
                $('.row-password').addClass('has-error').removeClass('has-success');
                $('#btn-submit').prop('disabled', true);
            }
        });

    });
</script>
@endpush
