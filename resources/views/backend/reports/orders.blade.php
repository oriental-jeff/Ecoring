@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])
<style>
    thead tr th {
        font-size: 14px;
        font-weight: bold;
    }

    tbody tr td {
        font-size: 14px;
        vertical-align: middle !important;
        padding: 0.2rem !important;
    }

    .panel-heading {
        letter-spacing: 1px;
    }

    .control-label-head {
        font-size: 18px;
        color: black;
        font-weight: bold;
        letter-spacing: 1px;
        text-decoration: underline;
    }

    .control-label-title {
        font-size: 14px;
        color: black;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .control-label-answer {
        font-size: 14px;
        color: darkblue;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .control-label-blue {
        font-size: 14px;
        color: dodgerblue;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .control-label-red {
        font-size: 14px;
        color: crimson;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .control-label-green {
        font-size: 14px;
        color: seagreen;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .control-label-violet {
        font-size: 14px;
        color: violet;
        font-weight: bold;
        letter-spacing: 1px;
    }

    /* Text Colors */
    .text-blue {
        color: dodgerblue;
        font-weight: bold;
    }

    .text-red {
        color: crimson;
        font-weight: bold;
    }

    .text-green {
        color: seagreen;
        font-weight: bold;
    }

    .text-orange {
        color: orangered;
        font-weight: bold;
    }

    .text-violet {
        color: violet;
        font-weight: bold;
    }

    /* Data Table */
    .dataTables_info {
        font-size: 14px;
        color: dodgerblue;
        letter-spacing: 1px;
        font-weight: bold;
    }
</style>

@section('title')
<i class="fad fa-lg fa-file-alt"></i> รายงานการสั่งซื้อสินค้า
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
                            <label class="control-label-title">คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword" placeholder="หมายเลขคำสั่งซื้อ"
                                value="{{ $filter['keyword'] ?? '' }}" autofocus>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-lg-2">
                            <label class="control-label-title">วันที่ : จาก</label>
                            <input type="text" class="form-control" id="date-from" name="from"
                                value="{{ $filter['from'] ?? '' }}">
                        </div>

                        <div class="form-group col-md-4 col-lg-2">
                            <label class="control-label-title">วันที่ : ถึง</label>
                            <input type="text" class="form-control" id="date-to" name="to"
                                value="{{ $filter['to'] ?? '' }}">
                        </div>

                        <div class="form-group col-md-4 col-lg-2">
                            <label class="control-label-title">ประเภทการชำระเงิน</label>
                            <select name="payment_type" class="form-control">
                                <option value="all">-- ทั้งหมด --</option>
                                <option value="0" {{ $filter['type'] == '0' ? 'selected' : '' }}>โอนเข้าบัญชีธนาคาร
                                </option>
                                <option value="1" {{ $filter['type'] == '1' ? 'selected' : '' }}>ชำระผ่านบัตรเครดิต /
                                    เดบิต</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 col-lg-2">
                            <label class="control-label-title" for="status">สถานะ</label>
                            <select id="status" name="status" class="form-control">
                                <option value="all">-- ทั้งหมด --</option>
                                @foreach ($status as $item)
                                <option value="{{ $item->status_id }}"
                                    {{ $filter['status'] == "{$item->status_id}" ? 'selected' : '' }}>
                                    {{ $item->name_th }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
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
                        <label class="control-label-title">ยอดรวมราคาเต็ม : </label>
                        <label class="control-label-blue">{{ number_format($overall['gross'], 2) }} บาท</label>
                    </div>

                    <div class="form-group col-md-12 mb-3">
                        <label class="control-label-title">ยอดรวมส่วนลด : </label>
                        <label class="control-label-red">{{ number_format($overall['discount'], 2) }} บาท</label>
                    </div>

                    <div class="form-group col-md-12 mb-3">
                        <label class="control-label-title">ยอดรวมราคาหักส่วนลด : </label>
                        <label class="control-label-green">{{ number_format($overall['price'], 2) }} บาท</label>
                    </div>

                    <div class="form-group col-md-12 mb-3">
                        <label class="control-label-title">ยอดรวมราคาสุทธิ : </label>
                        <label class="control-label-violet">{{ number_format($overall['net'], 2) }} บาท</label>
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
                <div class="panel-heading">
                    <h4 class="mt-3">รายการการสั่งซื้อสินค้า ( {{ $display_orders }} / {{ $total_orders }} )</h4>
                </div>

                <div class="panel-body">
                    <table id="datatable-tools" class="table table-striped table-bordered w-100 nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>วันที่สั่งสินค้า</th>
                                <th>หมายเลขการสั่งซื้อ</th>
                                <th>สถานะ</th>
                                <th>การชำระเงิน</th>
                                <th>ราคาเต็ม</th>
                                <th>ส่วนลด</th>
                                <th>ราคาหักส่วนลด</th>
                                <th>ค่าจัดส่ง</th>
                                <th>ภาษี</th>
                                <th>ราคาสุทธิ ( ราคาสุทธิ + ค่าจัดส่ง )</th>
                                <th>การรับสินค้า</th>
                                <th>ช่องทางการจัดส่ง</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($lists as $item)
                            <tr class="text-center">
                                <td class="text-left">{{ $item['date_order'] }}</td>
                                <td>{{ $item['code'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['payment_name'] }}</td>
                                <td class="text-blue">{{ number_format($item['gross_price'], 2) }}</td>
                                <td class="text-red">{{ number_format($item['discount'], 2) }}</td>
                                <td class="text-green">{{ number_format($item['total_price'], 2) }}</td>
                                <td>{{ number_format($item['delivery_charge'], 2) }}</td>
                                <td class="text-orange">{{ number_format($item['vat'], 2) }}</td>
                                <td>
                                    <span class="text-violet">{{ number_format($item['net_price'], 2) }}</span>
                                    ( {{ number_format($item['net_price_delivery'], 2) }} )
                                </td>
                                <td>{{ $item['pickup'] }}</td>
                                <td>
                                    <a class="fancybox" rel="gallery1" href="{{ $item['logistic_image'] ?? '' }}"
                                        title="{{ $item['logistic_name'] }}">
                                        <img src="{{ $item['logistic_image'] ?? '' }}" class="img-table" />
                                    </a>
                                </td>
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
            window.location.replace(base_url + '/backend/reports/orders');
        }

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
