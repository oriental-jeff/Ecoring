@extends('backend.layouts.header')
@section('title')
บริษัทขนส่ง
@endsection
@section('content')

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form id="" action="{{ route('backend.logistics.index') }}" method='post' data-parsley-validate="true">
                    @method('get')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4 col-lg-2">
                            <label for="StopDate">คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword"
                                value="{{ request('keyword') ?? '' }}">
                        </div>
                        <div class="form-group col-md-4 col-lg-2">
                            <label for="active">Status</label>
                            <select id="active" name="active" class="form-control">
                                <option value="">All</option>
                                <option value="1" {{ request('active') === "1" ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('active') === "0" ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                            <div class='mt-4 '>
                                <button type="submit" class="btn btn-white btn-search" id="search"><i
                                        class='fas fa-search text-info'></i> ค้นหา</button>
                                @can('add logistics')
                                <a href="{{ route('backend.logistics.create') }}" class="btn btn-white btn-search"><i
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
                                <th class="text-center">รูป</th>
                                <th class="text-center">ชื่อเรียก (ไทย)</th>
                                <th class="text-center">ชื่อเรียก (อังกฤษ)</th>
                                <th class="text-center">ระยะเวลา</th>
                                <th class="text-center">ราคาตั้งต้น</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">ผู้แก้ไขล่าสุด</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(!empty($logistics))
                            @foreach($logistics as $logistic)
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
                                            @can('delete logistics')
                                            <form
                                                action="{{ route('backend.logistics.destroy', ['logistic' => $logistic->id]) }}"
                                                method="post">
                                                {{ method_field('DELETE') }}
                                                <button class="del-trans dropdown-item" data-id="" data-module="Del"
                                                    data-controller=""><i
                                                        class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ</button>
                                                @csrf
                                            </form>
                                            @endcan
                                            @can('edit logistics')
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('backend.logistics.edit', ['logistic' => $logistic->id]) }}"
                                                class=" edit  dropdown-item" data-id=""><i
                                                    class="fa fa-pencil-alt text-warning"></i>&nbsp;&nbsp;แก้ไข</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($logistic->updated_at)) }}</td>
                                <td class="text-center">
                                    <a class="fancybox" rel="gallery1" href="{{ $logistic->image ?? '' }}"
                                        title="{{ $logistic->name_th }}">
                                        <img src="{{ $logistic->image ?? '' }}" class="img-table" />
                                    </a>
                                </td>
                                <td class="text-left">{{ $logistic->name_th }}</td>
                                <td class="text-left">{{ $logistic->name_en }}</td>
                                <td class="text-center">{{ $logistic->period }}</td>
                                <td class="text-center">{{ number_format($logistic->base_price, 2) }}</td>
                                <td class="text-center">{{ $logistic->active }}</td>
                                <td class="text-center">{{ $logistic->update_name->first_name }}</td>
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
