@extends('backend.layouts.header')
@section('title')
	Trash
@endsection
@section('content')
	<div class="row">
   	<div class="col-12 col-xl-12">
      @if(!empty($trash))
        @foreach($trash as $model => $row_trash)
          <div class="col-lg-12 col-md-12">
            <div class="panel panel-inverse">
              <div class="panel-heading">
                <h4 class="panel-title">{{ ucfirst($model) }} Trash 
                  <div class="panel-heading-btn">     
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  </div>
                </h4>

              </div>
              <div class="panel-body">
              @if(!empty($row_trash))
                <div class="alert alert-green fade show">
                  @can('restore_all trash')
                    <a class="btn btn-sm btn-info" href="{{ route('backend.trash.restore-all', ['model' => $model]) }}">
                    Restore All
                    </a>
                  @endcan
                  @can('trash_all trash')
                    <a class="btn btn-sm btn-danger" href="{{ route('backend.trash.remove-all', ['model' => $model]) }}">
                    Remove All
                    </a>
                  @endcan
                </div>
              @endif
                
                <table class='table table-striped table-bordered data-table-nosort w-100'>
                  <thead>
                    <tr>
                      <th class='text-center'>จัดการ</th>
                      <th class='text-center'>ชื่อ</th>
                      <th class='text-center'>วันที่ลบ</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @if(!empty($row_trash))
                      @foreach($row_trash as $model_trash)
                        <tr>
                          <td>
                            @can('remove trash')
                              <a href="{{ route('backend.trash.restore', [$model, $model_trash->id]) }}" class="card-link text-info ml-2"><i class="fas fa-sync fa-spin"></i> Restore</a>
                            @endcan
                            @can('restore trash')
                              <a href="{{ route('backend.trash.remove', [$model, $model_trash->id]) }}" class="card-link text-danger"><i class="fas fa-trash-alt"></i> Remove</a>
                            @endcan
                          </td>
                          <td><div class='ml-2'>{{ $model_trash->name }}</div></td>
                          <td><div class='ml-2'>{{ date('d/m/Y H:i:s', strtotime($model_trash->deleted_at)) }}</div></td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div> 
        @endforeach
      @endif
    </div>
  </div>


@endsection

@push('after-scripts')
  <script>
    $('a[href$="restore-all"]').on('click', function(){
      return confirm('ต้องการ Restore All ?');
    });
    $('a[href$="remove-all"]').on('click', function(){
      return confirm('ต้องการ Remove Permanently All ?');
    });
    $('a[href$="restore"]').on('click', function(){
      return confirm('ต้องการ Restore ?');
    });
    $('a[href$="remove"]').on('click', function(){
      return confirm('ต้องการ Remove Permanently ?');
    });
   var table_no_sort = $('.data-table-nosort').DataTable({
          retrieve: true,
          "language": {
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
            "info": "แสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่พบจำนวนรายการ",
            "search": "ค้นหา",
            "paginate": {
              "first": "หน้าแรก",
              "last": "หน้าสุดท้าย",
              "next": "ถัดไป",
              "previous": "ก่อนหน้า"
            }
          },
          //responsive: true,
          "columnDefs": [{ "width" : "150px", "targets" : 0 }]

          ,
          searching: true,
          "ordering": false,
          //scrollX: true,
          //fixedColumns: true,
          scrollCollapse: true,
          fixedColumns: true,
             
      });  

  </script>
@endpush


