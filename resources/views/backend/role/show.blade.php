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
                    <th class="text-center">วันที่สร้าง</th>
                    <th class="text-center">ตำแหน่ง</th>
                    <th class="text-center">แก้ไขล่าสุด</th>
                  </tr>
                </thead>
                <tbody>
                
                  @if(!empty($roles)) 
                    @foreach($roles as $role)
                      <tr class='del'>
                        <td class="text-center">
                          <div class=" dropright" >
                            <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-bars "></i>
                               <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            @if($role->name != 'super admin')
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              @can('delete role list')
                                <form action="{{ url('backend/role/'.$role->id) }}" method='post' >
                                 {{ method_field('DELETE') }}
                                   <button class="del-trans  dropdown-item" data-id="" data-module="Del" data-controller="" 
                                    ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ </button>
                                     @csrf
                                </form>
                              @endcan
                              @can('edit role list')
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('backend/role/'.$role->id.'/edit') }}" class=" edit  dropdown-item" data-id="" ><i class="fa fa-pencil-alt text-warning" target='_blank'></i>&nbsp;&nbsp; แก้ไข </a>
                              @endcan
                            </div>
                          @endif
                        </div>
                        </td>

                        <td class='text-center'>{{ date('d/m/Y H:i:s', strtotime($role->created_at)) }}</td>
                        <td class='text-left'>{{ $role->name }}</td>
                        <td class='text-left'>{{  date('d/m/Y H:i:s', strtotime($role->updated_at)) }}</td>
      
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
     

      <?php  $colum_width = json_encode(
      array([ "width" => "40px", "targets" => 0 ],
            [ "width" => "100px", "targets" => 1 ],
            [ "width" => "100px", "targets" => 2 ],
            [ "width" => false, "targets" => 3 ],
            

          )
      ); ?>

  <script>
    var colum_width = '<?php echo $colum_width; ?>';
  </script>
