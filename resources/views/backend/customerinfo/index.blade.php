@extends('backend.layouts.header', ['css' => ['font' => 'K2D']])

<style>
    thead tr th { font-size: 14px; font-weight: bold; }
    tbody tr td { font-size: 14px; vertical-align: middle !important; padding: 0.2rem !important; }
    form { margin: 0; }

    .panel-heading { letter-spacing: 1px; }
    .control-label { font-size: 14px; color: black; font-weight: bold; letter-spacing: 1px; }

    /* Data Table */
    .dataTables_info { font-size: 14px; color: dodgerblue; letter-spacing: 1px; font-weight: bold; }
</style>

@section('title')
    <i class="fad fa-lg fa-users"></i> ข้อมูลลูกค้า
@endsection

@section('content')
{{-- Form --}}
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="panel panel-inverse gray">
            <div class="panel-body mgbt">
                <form action="{{ route('backend.customerinfo.index') }}" method='post' data-parsley-validate="true">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="form-group col-md-4 col-lg-3">
                            <label class="control-label">คีย์เวิร์ด </label>
                            <input type="text" class="form-control" name="keyword" placeholder="ชื่อ - นามสกุล หรือ อีเมลล์ หรือ เบอร์โทร"
                            value="{{ request('keyword') ?? '' }}" autofocus>
                        </div>
                    </div>

                    <div class="row">
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

{{-- Table --}}
<div class='return-list'>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel ">
                <div class="panel-heading">
                    <h4 class="mt-3">รายชื่อข้อมูลลูกค้า ( {{ $display_customer }} / {{ $total_customer }} )</h4>
                </div>

                <div class="panel-body">
                    <table id="data-table-list" class="table table-striped table-bordered w-100 nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>Actions</th>
                                <th>#</th>
                                <th>เพศ</th>
                                <th>สถานะ</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>อีเมล์</th>
                                <th>การผูก Social</th>
                                <th>เบอร์โทรฯ</th>
                                <th>การยืนยันอีเมล์</th>
                                <th>สมัครเมื่อ</th>
                                <th>แก้ไขล่าสุดเมื่อ</th>
                                <th>แก้ไขโดย</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($lists as $key => $item)
                                <tr class="text-center">
                                    <td>
                                        <div class=" dropright">
                                            <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fad fa-lg fa-bars"></i>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ route('backend.customerinfo.edit', ['customerinfo' => $item['user_id']]) }}" class="dropdown-item font-weight-bold text-left">
                                                    <i class="fas fa-lg fa-wrench text-warning"></i> แก้ไขข้อมูล
                                                </a>

                                                <div class="dropdown-divider"></div>

                                                <a href="{{ route('backend.customerinfo.edit_shipping', $item['user_id']) }}" class="dropdown-item font-weight-bold text-left">
                                                    <i class="fas fa-lg fa-shipping-fast text-info"></i> แก้ไขที่อยู่จัดส่ง
                                                </a>

                                                <div class="dropdown-divider"></div>

                                                <a href="{{ route('backend.customerinfo.edit_password', $item['user_id']) }}" class="dropdown-item font-weight-bold text-left">
                                                    <i class="fas fa-lg fa-key text-danger"></i> เปลี่ยนรหัสผ่าน
                                                </a>

                                                <div class="dropdown-divider"></div>

                                                @if ($item['status'] == 'Activated')
                                                    <a href="{{ route('backend.customerinfo.deactivated_user', $item['user_id']) }}"
                                                    class="dropdown-item font-weight-bold text-left">
                                                        <i class="fas fa-lg fa-power-off text-dark"></i> ปิดการใช้งาน
                                                    </a>
                                                @else
                                                    <a href="{{ route('backend.customerinfo.activated_user', $item['user_id']) }}"
                                                    class="dropdown-item font-weight-bold text-left">
                                                        <i class="fas fa-lg fa-plug text-primary"></i> เปิดการใช้งาน
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item['count'] }}</td>
                                    <td>{!! $item['gender'] !!}</td>
                                    <td class="font-weight-bold {{ $item['class_status'] }}">{{ $item['status'] }}</td>
                                    <td class="text-left">{{ $item['fullname'] }}</td>
                                    <td class="text-left">{{ $item['email'] }}</td>
                                    <td>{{ $item['bind_social'] }}</td>
                                    <td>{{ $item['telephone'] }}</td>
                                    <td>{!! $item['confirmed_email_icon'] !!}</td>
                                    <td class="text-left">{{ $item['created_date'] }}</td>
                                    <td class="text-left">{{ $item['updated_date'] }}</td>
                                    <td>{{ $item['updated_by'] }}</td>
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

{{-- Config Table Columns Width --}}
<?php
    $colum_width = json_encode(
        [
            [ "width" => "40px", "targets" => 0 ],
            [ "width" => "150px", "targets" => 4 ],
            [ "width" => "150px", "targets" => 5 ],
        ]
    );
?>

<script>
    var colum_width = '<?PHP echo $colum_width; ?>';
</script>
@endsection

@push('after-scripts')
    <script>
        function viewAll() {
            window.location.replace(base_url + '/backend/customerinfo');
        }

        data_table_list.columns.adjust().draw();
    </script>
@endpush
