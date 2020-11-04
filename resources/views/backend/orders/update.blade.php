@extends('backend.layouts.header', ['script' =>['editor' => true], 'css' => ['font' => 'K2D']])

<style>
    .text-white { letter-spacing: 1px; }
    .text-success { letter-spacing: 1px; text-decoration: underline; }
    .control-label-title, .dataTables_info { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; }
    .control-label-answer { font-size: 14px; color: darkblue; font-weight: bold; letter-spacing: 1px; }
    .control-label-red { font-size: 14px; color: red; font-weight: bold; letter-spacing: 1px; }
    .control-label-jumbo { font-size: 20px; color: seagreen; font-weight: bold; letter-spacing: 1px; }
</style>

@section('title')
    <i class="fad fa-lg fa-bags-shopping"></i> แก้ไขรายการสั่งซื้อ
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel" data-sortable-id="form-validation-1">
            <div class="panel-heading panel-black">
                <h4 class="text-white">แบบฟอร์มข้อมูลสินค้า</h4>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" id="form-validate" name="demo-form" enctype="multipart/form-data"
                    action="{{ route('backend.orders.update', ['order' => $order[0]->id] ) }}" method='post'>
                    @method('PATCH')
                    @include('backend.orders.form')
                    @csrf
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
