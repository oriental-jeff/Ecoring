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
                  <tr>
                    <!-- <th width="1%">ลำดับ</th> -->
                    <th class="text-center">จัดการ</th>
                    <th class="text-center">วันที่อัพเดต</th>
                    <th class="text-center">ชื่อหน้า</th>
                    <th class="text-center">Title(ไทย)</th>
                    <th class="text-center">Title(อังกฤษ)</th>
                    <th class="text-center">ผู้แก้ไขล่าสุด</th>
                  </tr>
                </thead>
                <tbody>
                
                  @if(!empty($pages)) 
                    @foreach($pages as $page)
                      <tr class='del'>
                        <td class="text-center">
                          <div class="dropright">
                            <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-bars "></i>
                               <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @can('delete page')
                              <form action="{{ route('backend.page.destroy', ['page' => $page->id]) }}" method='post' >
                               {{ method_field('DELETE') }}
                                 <button class="del-trans  dropdown-item" data-id="" data-module="Del" data-controller="" 
                                  ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ </button>
                                   @csrf
                              </form>
                            @endcan
                            @can('edit page')
                              <div class="dropdown-divider"></div>
                              <a href="{{ route('backend.page.edit', ['page' => $page->id]) }}" class=" edit  dropdown-item" data-id="" ><i class="fa fa-pencil-alt text-warning"></i>&nbsp;&nbsp; แก้ไข </a>
                            @endcan

                          </div>
                        </div>
                        </td>

                        <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($page->updated_at)) }}</td>
                        <td class="text-left">{{ $page->name }}</td>
                        <td class="text-left">{{ $page->title_th }}</td>
                        <td class="text-left">{{ $page->title_en }}</td>
                        <td class="text-center">{{ $page->update_name->name }}</td>
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