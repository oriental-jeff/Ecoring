@extends('backend.layouts.header')
@section('title')
แบนเนอร์
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form id="form_search" action="{{ route('backend.banner.index') }}" method='post'
                    data-parsley-validate="true">
                    <div class="form-row">
                        <div class="form-group col-md-4 col-lg-2">
                            <label for="StopDate">คีย์เวิร์ด </label>
                            <input type="text" class="form-control " name="keyword"
                                value="{{ request('keyword') ?? '' }}">
                        </div>
                        <div class="form-group col-lg-6 col-md-12 col-sm-12 ">
                            <div class='mt-4 '>
                                <button type="button" class="btn btn-white btn-search search" id="search"><i
                                        class='fas fa-search text-info'></i> ค้นหา </button>
                                @can('add banner')
                                <a href="{{ route('backend.banner.create') }}" class="btn btn-white btn-search"><i
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

<div class='return-list'>
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel ">
                <!-- begin panel-heading -->
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-list" class="table table-striped table-bordered w-100 nowrap ">
                        <thead>
                            <tr class="text-center">
                                <!-- <th width="1%">ลำดับ</th> -->
                                <th>จัดการ</th>
                                <th>วันที่อัพเดต</th>
                                <th>หน้า</th>
                                <th>ตำแหน่งในหน้า</th>
                                <th>รูป</th>
                                <th>ชื่อ</th>
                                <th>url</th>
                                <th>ผู้แก้ไขล่าสุด</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(!empty($banners))
                            @foreach($banners as $banner)
                            <tr class="del text-center">
                                <td>
                                    <div class="dropright">
                                        <button class="btn btn-white dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-bars "></i>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            {{-- @can('delete banner')
                              <form action="{{ route('backend.banner.destroy', ['banner' => $banner->id]) }}"
                                            method='post' >
                                            {{ method_field('DELETE') }}
                                            <button class="del-trans  dropdown-item" data-id="" data-module="Del"
                                                data-controller=""><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp;
                                                ลบ </button>
                                            @csrf
                                            </form>
                                            @endcan --}}
                                            @can('edit banner')
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('backend.banner.edit', ['banner' => $banner->id]) }}"
                                                class=" edit  dropdown-item" data-id=""><i
                                                    class="fa fa-pencil-alt text-warning"></i>&nbsp;&nbsp; แก้ไข </a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    {{ !empty($banner->banners_detail[0]->updated_at) ? $banner->banners_detail[0]->updated_at->format('d/m/Y H:i:s') : '' }}
                                </td>
                                <td>{{ $banner->pages->title_th }}</td>
                                <td>{{ $banner->position }}</td>
                                <td>
                                    @if(collect($banner->banners_detail)->first()->type == 'image')
                                    <img src="{{ collect($banner->banners_detail)->first()->slide_banner_pc ?? '' }}"
                                        class='img-table'>
                                    @elseif(collect($banner->banners_detail)->first()->type == 'video')
                                    <video class='w-100' controls>
                                        <source src="{{collect($banner->banners_detail)->first()->banner_video}}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    @endif
                                </td>
                                <td class='text-left'>{{ $banner->name }}</td>
                                <td class='text-left'>{{collect($banner->banners_detail)->first()->url }}</td>
                                <td>
                                    {{ collect($banner->banners_detail)->first()->update_name->name }}</td>
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
	          [ "width" => "100px", "targets" => 2 ],
	          [ "width" => "150px", "targets" => 3 ],
            [ "width" => "200px", "targets" => 4 ],

	        )
	    ); ?>

<script>
    var colum_width = '<?php echo $colum_width; ?>';
</script>

@endsection

@push('after-scripts')
<script>
    data_table_list.columns.adjust().draw();
</script>

@endpush
