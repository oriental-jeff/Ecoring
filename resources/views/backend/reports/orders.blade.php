@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])

@section('title')
    <i class="fal fa-lg fa-file-alt"></i> รายงานการสั่งซื้อสินค้า
@endsection

@section('content')
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

                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                            <div class='mt-4 '>
                                <button type="submit" class="btn btn-white btn-search" id="search"><i
                                        class='fas fa-search text-info'></i> ค้นหา</button>
                                {{-- @can('add orders')
                                <a href="{{ route('backend.orders.create') }}" class="btn btn-white btn-search"><i
                                    class="fa fa-plus-square fa-lg text-success"></i> เพิ่มข้อมูล</a>
                                @endcan --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="return-list">
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel">
                <!-- begin panel-heading -->

                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="datatable-tools" class="table table-striped table-bordered w-100 nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>วันที่สั่งสินค้า</th>
                                <th>หมายเลขการสั่งซื้อ</th>
                                <th>สถานะ</th>
                                <th>การชำระเงิน</th>
                                <th>ยอดรวมทั้งสิ้น</th>
                                <th>การรับสินค้า</th>
                                <th>ช่องทางการจัดส่ง</th>
                                <th>อัตราค่าบริการ</th>
                                <th>จัดส่งใบแจ้งหนี้</th>
                                <th>วันที่จัดส่งใบแจ้งหนี้</th>
                                <th>จัดส่งใบเสร็จ</th>
                                <th>วันที่จัดส่งใบเสร็จ</th>
                                <th>Tracking No.</th>
                                <th>ผู้แก้ไขล่าสุด</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(!empty($orders))
                            @foreach($orders as $order)
                            {{ $order->product }}
                            <tr class="text-center del">
                                <td class="text-left">
                                    {{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}
                                </td>
                                <td>{{ $order->code }}</td>
                                <td class="text-left">{{ $order->status_config->name_th }}</td>
                                <td class="text-left">
                                    {{ $order->payment_type }}
                                </td>
                                <td class="text-right">
                                    ฿{{ number_format($order->total_amount + $order->delivery_charge + $order->vat, 2) }}
                                </td>
                                <td>
                                    {{ $order->pickup_optional == 0 ? 'ใช้ช่องทางการจัดส่ง' : 'มารับสินค้าเอง'  }}
                                </td>
                                <td>
                                    <a class="fancybox" rel="gallery1" href="{{ $order->logistic->image ?? '' }}"
                                        title="{{ $order->logistic->name_th }}">
                                        <img src="{{ $order->logistic->image ?? '' }}" class="img-table" />
                                    </a>
                                </td>
                                </td>
                                <td>{{ number_format($order->delivery_charge, 2) }}</td>
                                <td>{{ $order->po_sent_count }}</td>
                                <td>
                                    {{ $order->po_sent_last ? date('d/m/Y H:i:s', strtotime($order->po_sent_last)) : '' }}
                                </td>
                                <td>{{ $order->rcpt_sent_count }}</td>
                                <td>
                                    {{ $order->rcpt_sent_last ? date('d/m/Y H:i:s', strtotime($order->rcpt_sent_last)) : '' }}
                                </td>
                                <td class="text-left">{{ $order->tracking_no }}</td>
                                <td>{{ $order->update_name->first_name }}</td>
                            </tr>
                            @endforeach
                            @endif
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
