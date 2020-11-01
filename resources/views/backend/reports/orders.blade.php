@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])
<style>
  thead tr th { font-size: 14px; font-weight: bold; }
	tbody tr td { font-size: 14px; vertical-align: middle !important; padding: 0.2rem !important; }
  .control-label-head { font-size: 18px; color: black; font-weight: bold; letter-spacing: 1px; text-decoration: underline; }
  .control-label-title { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; }
  .control-label-answer { font-size: 14px; color: darkblue; font-weight: bold; letter-spacing: 1px; }
</style>

@section('title')
    <i class="fal fa-lg fa-file-alt"></i> รายงานการสั่งซื้อสินค้า
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
                    {{-- <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword" autofocus>
                        </div>
                    </div> --}}

                    <div class="form-row">
                        <div class="form-group col-md-4 col-lg-2">
                            <label>วันที่ : จาก</label>
                            <input type="text" class="form-control" id="date-from" name="from">
                        </div>

                        <div class="form-group col-md-4 col-lg-2">
                            <label>วันที่ : ถึง</label>
                            <input type="text" class="form-control" id="date-to" name="to">
                        </div>

                        <div class="form-group col-md-4 col-lg-2">
                            <label>ประเภทการชำระเงิน</label>
                            <select name="payment_type" class="form-control">
                                <option value="all">-- ทั้งหมด --</option>
                                <option value="0">โอนเข้าบัญชีธนาคาร</option>
                                <option value="1">ชำระผ่านบัตรเครดิต / เดบิต</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 col-lg-2">
                            <label for="status">สถานะ</label>
                            <select id="status" name="status" class="form-control">
                                <option value="all">-- ทั้งหมด --</option>
                                @foreach ($status as $item)
                                  <option value="{{ $item->status_id }}">
                                      {{ $item->name_th }}
                                  </option>
                                @endforeach
                            </select>
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

{{-- OVERALL --}}
<div class="row">
  <div class="col-12">
      <div class="panel panel-inverse gray">
          <div class="panel-body mgbt">
            <div class="row">
              <div class="form-group col-md-12 mb-3">
                <label class="control-label-head">Overall</label>
              </div>

              <div class="form-group col-md-12 mb-3">
                <label class="control-label-title">ยอดรวมทั้งสิ้น : </label>
                <label class="control-label-answer">{{ number_format($overall['total'], 2) }} บาท</label>
              </div>
            </div>
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
                                <th>วันที่สั่งสินค้า</th>
                                <th>หมายเลขการสั่งซื้อ</th>
                                <th>สถานะ</th>
                                <th>การชำระเงิน</th>
                                <th>ราคาสินค้า</th>
                                <th>การรับสินค้า</th>
                                <th>ช่องทางการจัดส่ง</th>
                                <th>อัตราค่าบริการ</th>
                            </tr>
                        </thead>

                        <tbody>
                          @foreach ($lists as $item)
                              <tr class="text-center">
                                <td class="text-left">{{ $item['date_order'] }}</td>
                                <td>{{ $item['code'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['payment_name'] }}</td>
                                <td>{{ number_format($item['total_amount'], 2) }}</td>
                                <td>{{ $item['pickup'] }}</td>
                                <td>
                                  <a class="fancybox" rel="gallery1" href="{{ $item['logistic_image'] ?? '' }}"
                                    title="{{ $item['logistic_name'] }}">
                                    <img src="{{ $item['logistic_image'] ?? '' }}" class="img-table" />
                                  </a>
                                </td>
                                <td>{{ $item['delivery_charge'] }}</td>
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
            $('#date-from, #date-to').datetimepicker({
                format: 'DD/MM/YYYY'
            });

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

            $(".fancybox").fancybox({openEffect: 'none', closeEffect: 'none'});
        });
    </script>
@endpush
