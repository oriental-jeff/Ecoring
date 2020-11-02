@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])
<style>
  thead tr th { font-size: 14px; font-weight: bold; }
  tbody tr td { font-size: 14px; vertical-align: middle !important; padding: 0.2rem !important; }
  .panel-heading { letter-spacing: 1px; }
  .control-label-head { font-size: 18px; color: black; font-weight: bold; letter-spacing: 1px; text-decoration: underline; }
  .control-label-title { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; }
  .control-label-answer { font-size: 14px; color: darkblue; font-weight: bold; letter-spacing: 1px; }

  /* Data Table */
  .dataTables_info { font-size: 14px; color: dodgerblue; letter-spacing: 1px; font-weight: bold; }
</style>

@section('title')
    <i class="fad fa-lg fa-file-certificate"></i> รายงานข้อมูลลูกค้า
@endsection

@section('content')
{{-- FORM --}}
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form id="" action="{{ route('backend.reports.customers') }}" method='post' data-parsley-validate="true">
                    @method('get')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="control-label-title">คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword" placeholder="ชื่อ - นามสกุล หรือ อีเมล์ หรือ เบอร์โทร"
                            value="{{ $filter['keyword'] ?? '' }}" autofocus>
                        </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary btn-search mr-3">
                            <i class='fal fa-lg fa-search'></i> ค้นหา
                        </button>

                        <button type="button" class="btn btn-outline-primary btn-search" onclick="viewAll()">
                            <i class='fal fa-lg fa-sync-alt'></i> ดูทั้งหมด
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
                <div class="panel-heading">
                    <h4 class="mt-3">รายชื่อข้อมูลลูกค้า ( {{ $display_users }} / {{ $total_users }} )</h4>
                </div>

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
                                  <td>{{ $item['count'] }}</td>
                                  <td>{{ $item['gender'] }}</td>
                                  <td>{{ $item['fullname'] }}</td>
                                  <td class="text-left">{{ $item['email'] }}</td>
                                  <td>{{ $item['tel'] }}</td>
                                  <td class="text-left">{{ $item['birthdate'] }}</td>
                                  <td>{{ $item['bind_social'] }}</td>
                                  <td>{{ $item['confirm_email'] }}</td>
                                  <td>{{ $item['total_delivery_address'] }}</td>
                                  <td class="text-left">{{ $item['register_date'] }}</td>
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
        function viewAll() {
            window.location.replace(base_url + '/backend/reports/customers');
        }

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
