@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])
<style>
  thead tr th { font-size: 14px; font-weight: bold; }
	tbody tr td { font-size: 14px; vertical-align: middle !important; padding: 0.2rem !important; }
  .control-label-head { font-size: 18px; color: black; font-weight: bold; letter-spacing: 1px; text-decoration: underline; }
  .control-label-title { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; }
  .control-label-answer { font-size: 14px; color: darkblue; font-weight: bold; letter-spacing: 1px; }
</style>

@section('title')
    <i class="fal fa-lg fa-file-alt"></i> รายงานข้อมูลลูกค้า
@endsection

@section('content')
{{-- FORM --}}
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form id="" action="{{ route('backend.reports.orders') }}" method='post' data-parsley-validate="true">
                    @method('get')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword" autofocus>
                        </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-lg-6 col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-white btn-search" id="search">
                          <i class='fas fa-search text-info'></i> ค้นหา
                        </button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="return-list">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <table id="datatable-tools" class="table table-striped table-bordered w-100 nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>เพศ</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>อีเมล์</th>
                                <th>เบอร์โทร</th>
                                <th>วันเกิด</th>
                                <th>การผูก Social</th>
                                <th>การยืนยันอีเมล์</th>
                                <th>จำนวนที่อยู่จัดส่ง</th>
                                <th>สมัครเมื่อ</th>
                            </tr>
                        </thead>

                        <tbody>
                          @foreach ($lists as $item)
                              <tr class="text-center">

                              </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>

<?php
$colum_width = json_encode(array([ "width" => "40px", "targets" => 0 ], [ "width" => "100px", "targets" => 1 ]));
?>

<script>
    var colum_width = '<?php echo $colum_width; ?>';
</script>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#datatable-tools').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf', 'print'],
                "lengthMenu": [10, 25, 50, 75, 100],
                retrieve: true,
                searching: true,
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: true,
                scrollY: '50vh',
                "drawCallback": function (settings) {
                    $('[data-toggle="tooltip"]').tooltip({
                        container: 'body',
                        "html": true,
                    });
                }
            }).columns.adjust().draw();
        });
    </script>
@endpush
