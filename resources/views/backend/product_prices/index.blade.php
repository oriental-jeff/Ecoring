@extends('backend.layouts.header')
@section('title')
ราคาสินค้า (ตามช่วงเวลา)
@endsection
@section('content')

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form id="" action="{{ route('backend.product_prices.index') }}" method='post'
                    data-parsley-validate="true">
                    @method('get')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4 col-lg-2">
                            <label for="StopDate">คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword"
                                value="{{ request('keyword') ?? '' }}">
                        </div>
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                            <div class='mt-4 '>
                                <button type="submit" class="btn btn-white btn-search" id="search"><i
                                        class='fas fa-search text-info'></i> ค้นหา</button>
                                @can('add product_prices')
                                <a href="{{ route('backend.product_prices.create') }}"
                                    class="btn btn-white btn-search"><i
                                        class="fa fa-plus-square fa-lg text-success"></i> เพิ่มข้อมูล</a>
                                @endcan
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
                                <th class="text-center">วันที่อัพเดท</th>
                                <th class="text-left">สินค้า</th>
                                <th class="text-center">ราคา</th>
                                <th class="text-center">วันที่เริ่ม</th>
                                <th class="text-center">ผู้แก้ไขล่าสุด</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(!empty($product_prices))
                            @foreach($product_prices as $product_price)
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
                                            @can('delete product_prices')
                                            <form
                                                action="{{ route('backend.product_prices.destroy', ['product_price' => $product_price->id]) }}"
                                                method="post">
                                                {{ method_field('DELETE') }}
                                                <button class="del-trans dropdown-item" data-id="" data-module="Del"
                                                    data-controller=""><i
                                                        class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ</button>
                                                @csrf
                                            </form>
                                            @endcan
                                            @can('edit product_prices')
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('backend.product_prices.edit', ['product_price' => $product_price->id]) }}"
                                                class=" edit  dropdown-item" data-id=""><i
                                                    class="fa fa-pencil-alt text-warning"></i>&nbsp;&nbsp;แก้ไข</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ date('d/m/Y H:i:s', strtotime($product_price->updated_at)) }}
                                </td>
                                <td class="text-left">{{ $product_price->products->name_th }}</td>
                                <td class="text-right">{{ number_format($product_price->price, 2) }}</td>
                                <td class="text-center">
                                    {{ date('d/m/Y', strtotime($product_price->start_at)) }}</td>
                                <td class="text-center">{{ $product_price->update_name->first_name }}</td>
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
