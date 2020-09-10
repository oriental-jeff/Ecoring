@extends('backend.layouts.header')
@section('title')
	สิทธิ์เข้าใช้งาน
@endsection
@section('content')

	<div class="row">
   	<div class="col-12 col-xl-12">
      <div class="panel panel-inverse gray">
         <div class="panel-body mgbt">
           <form id="form_search" action="{{route('backend.role.index')}}" method='post'>
             <div class="form-row">    
                <div class="form-group col-md-4 col-lg-2">
                 <label for="StopDate">คีย์เวิร์ด </label>
                 <input type="text" class="form-control " name="keyword" value="{{ request('keyword') ?? '' }}" >
               </div>
                <div class="form-group col-lg-6 col-md-12 col-sm-12 ">
                  <div class='mt-4 '>
                    <button type="button" class="btn btn-white btn-search search" id="search"><i class='fas fa-search text-info'></i> ค้นหา </button>
                    @can('add role')
                      <a href="{{ route('backend.role.create') }}" class="btn btn-white btn-search"><i class="fa fa-plus-square fa-lg text-success"></i> เพิ่มข้อมูล</a>
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
                              @can('delete role')
                                <form action="{{ route('backend.role.destroy', ['role' => $role->id]) }}" method='post' >
                                 {{ method_field('DELETE') }}
                                   <button class="del-trans  dropdown-item" data-id="" data-module="Del" data-controller="" 
                                    ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ </button>
                                     @csrf
                                </form>
                              @endcan
                              @can('edit role')
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('backend.role.edit', ['role' => $role->id]) }}" class=" edit  dropdown-item" data-id="" ><i class="fa fa-pencil-alt text-warning" target='_blank'></i>&nbsp;&nbsp; แก้ไข </a>
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


	</div>
	 



	

@endsection


