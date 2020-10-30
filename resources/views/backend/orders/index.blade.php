@extends('backend.layouts.header')
@section('title')
รายการสั่งซื้อ
@endsection
@section('content')

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form id="" action="{{ route('backend.orders.index') }}" method='post' data-parsley-validate="true">
                    @method('get')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4 col-lg-2">
                            <label for="StopDate">คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword"
                                value="{{ request('keyword') ?? '' }}">
                        </div>
                        <div class="form-group col-md-4 col-lg-2">
                            <label for="status">สถานะ</label>
                            <select id="status" name="status" class="form-control">
                                <option value="">ทั้งหมด</option>
                                @foreach ($status as $item)
                                <option value="{{ $item->status_id }}"
                                    {{ !is_null(request('status')) ? (request('status') == $item->status_id ? 'selected' : '') : '' }}>
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
                    <table id="data-table-list" class="table table-striped table-bordered w-100 nowrap">
                        <thead>
                            <tr>
                                <!-- <th width="1%">ลำดับ</th> -->
                                <th class="text-center">จัดการ</th>
                                <th class="text-center">วันที่สั่งสินค้า</th>
                                <th class="text-center">หมายเลขการสั่งซื้อ</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">การชำระเงิน</th>
                                <th class="text-center">ยอดรวมทั้งสิ้น</th>
                                <th class="text-center">การรับสินค้า</th>
                                <th class="text-center">ช่องทางการจัดส่ง</th>
                                <th class="text-center">อัตราค่าบริการ</th>
                                <th class="text-center">จัดส่งใบแจ้งหนี้</th>
                                <th class="text-center">วันที่จัดส่งใบแจ้งหนี้</th>
                                <th class="text-center">จัดส่งใบเสร็จ</th>
                                <th class="text-center">วันที่จัดส่งใบเสร็จ</th>
                                <th class="text-center">Tracking No.</th>
                                <th class="text-center">ผู้แก้ไขล่าสุด</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(!empty($orders))
                            @foreach($orders as $order)
                            {{ $order->product }}
                            <tr class="del">
                                <td class="text-center">
                                    <div class=" dropright">
                                        <button class="btn btn-white dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-bars"></i>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @can('delete orders')
                                            <form
                                                action="{{ route('backend.orders.destroy', ['order' => $order->id]) }}"
                                                method="post">
                                                {{ method_field('DELETE') }}
                                                <button class="del-trans dropdown-item" data-id="" data-module="Del"
                                                    data-controller=""><i
                                                        class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ</button>
                                                @csrf
                                            </form>
                                            @endcan
                                            @can('edit orders')
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('backend.orders.edit', ['order' => $order->id]) }}"
                                                class=" edit  dropdown-item" data-id=""><i
                                                    class="fa fa-pencil-alt text-warning"></i>&nbsp;&nbsp;แก้ไข</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}
                                </td>
                                <td class="text-center">{{ $order->code }}</td>
                                <td class="text-left">{{ $order->status_config->name_th }}</td>
                                <td class="text-left">
                                    {{ $order->payment_type }}
                                </td>
                                <td class="text-right">
                                    ฿{{ number_format($order->total_amount + $order->delivery_charge + $order->vat, 2) }}
                                </td>
                                <td class="text-center">
                                    {{ $order->pickup_optional == 0 ? 'ใช้ช่องทางการจัดส่ง' : 'มารับสินค้าเอง'  }}
                                </td>
                                <td class="text-center">
                                    <a class="fancybox" rel="gallery1" href="{{ $order->logistic->image ?? '' }}"
                                        title="{{ $order->logistic->name_th }}">
                                        <img src="{{ $order->logistic->image ?? '' }}" class="img-table" />
                                    </a>
                                </td>
                                </td>
                                <td class="text-center">{{ number_format($order->delivery_charge, 2) }}</td>
                                <td class="text-center">{{ $order->po_sent_count }}</td>
                                <td class="text-center">
                                    {{ $order->po_sent_last ? date('d/m/Y H:i:s', strtotime($order->po_sent_last)) : '' }}
                                </td>
                                <td class="text-center">{{ $order->rcpt_sent_count }}</td>
                                <td class="text-center">
                                    {{ $order->rcpt_sent_last ? date('d/m/Y H:i:s', strtotime($order->rcpt_sent_last)) : '' }}
                                </td>
                                <td class="text-left">{{ $order->tracking_no }}</td>
                                <td class="text-center">{{ $order->update_name->first_name }}</td>
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

<?php  $colum_width = json_encode(
	    array([ "width" => "40px", "targets" => 0 ],
	          [ "width" => "100px", "targets" => 1 ],

	        )
	    ); ?>

<script>
    var colum_width = '<?php echo $colum_width; ?>';
</script>

@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect	: 'none',
            closeEffect	: 'none'
        });
    });
</script>
@endpush
