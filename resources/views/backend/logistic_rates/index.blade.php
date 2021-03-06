@extends('backend.layouts.header')
@section('title')
ค่าบริการขนส่ง
@endsection
@section('content')

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form id="" action="{{ route('backend.logistic_rates.index') }}" method='post'
                    data-parsley-validate="true">
                    @method('get')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4 col-lg-2">
                            <label for="StopDate">คีย์เวิร์ด</label>
                            <input type="text" class="form-control" name="keyword"
                                value="{{ request('keyword') ?? '' }}">
                        </div>
                        {{-- <div class="form-group col-lg-2 col-md-4 col-lg-2">
                            <label for="date_start">ช่วงของวันที่</label>
                            <input type="date" class="form-control" name="date_start"
                                value="{{ request('date_start') ?? '' }}">
                    </div>
                    <div class="form-group col-lg-2 col-md-4 col-lg-2">
                        <label for="date_end">&nbsp;</label>
                        <input type="date" class="form-control" name="date_end" value="{{ request('date_end') ?? '' }}">
                    </div> --}}
                    <div class="form-group col-lg-4 col-md-12 col-sm-12">
                        <div class='mt-4 '>
                            <button type="submit" class="btn btn-white btn-search" id="search"><i
                                    class='fas fa-search text-info'></i> ค้นหา</button>
                            @can('add logistic_rates')
                            <a href="{{ route('backend.logistic_rates.create') }}" class="btn btn-white btn-search"><i
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
                                <th class="text-center">บริษัทขนส่ง</th>
                                <th class="text-center">ช่วงน้ำหนัก (กรัม)</th>
                                <th class="text-center">ค่าบริการ</th>
                                <th class="text-center">วันที่เริ่ม</th>
                                <th class="text-center">วันที่สิ้นสุด</th>
                                <th class="text-center">ผู้แก้ไขล่าสุด</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(!empty($logistic_rates))
                            @foreach($logistic_rates as $logistic_rate)
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
                                            @can('delete logistic_rates')
                                            <form
                                                action="{{ route('backend.logistic_rates.destroy', ['logistic_rate' => $logistic_rate->id]) }}"
                                                method="post">
                                                {{ method_field('DELETE') }}
                                                <button class="del-trans dropdown-item" data-id="" data-module="Del"
                                                    data-controller=""><i
                                                        class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ</button>
                                                @csrf
                                            </form>
                                            @endcan
                                            @can('edit logistic_rates')
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('backend.logistic_rates.edit', ['logistic_rate' => $logistic_rate->id]) }}"
                                                class=" edit  dropdown-item" data-id=""><i
                                                    class="fa fa-pencil-alt text-warning"></i>&nbsp;&nbsp;แก้ไข</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($logistic_rate->updated_at)) }}
                                </td>
                                <td class="text-left">{{ $logistic_rate->logistic->name_th }}</td>
                                <td class="text-center">
                                    {{ $logistic_rate->weight_from. ' - ' .$logistic_rate->weight_to }}</td>
                                <td class="text-right">{{ $logistic_rate->price }}</td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($logistic_rate->start_at)) }}</td>
                                <td class="text-center">
                                    {{ $logistic_rate->end_at ? date('d/m/Y', strtotime($logistic_rate->end_at)) : '' }}
                                </td>
                                <td class="text-center">{{ $logistic_rate->update_name->first_name }}</td>
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
