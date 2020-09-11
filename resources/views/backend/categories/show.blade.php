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
                    <th class="text-center">Actions</th>
                    <th class="text-center">Last update</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Occupation</th>
                    <th class="text-center">Cover Picture</th>
                    <th class="text-center">Project Title</th>
                    <th class="text-center">Project Technique</th>
                    <th class="text-center">Fullname</th>
                    <th class="text-center">Profile Picture</th>
                    <th class="text-center">Institute / Organization</th>
                    <th class="text-center">Country</th>
                    <th class="text-center">Mobile</th>
                    <th class="text-center">E-mail</th>
                  </tr>
                </thead>
                <tbody>

                    @if(!empty($projects))
                    @foreach($projects as $project)
                      <tr class="del">
                        <td class="text-center">
                          <div class=" dropright">
                            <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-bars"></i>
                               <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              {{-- @can('delete application')
                                <form action="{{ route('backend.application.destroy', ['application' => $application->id]) }}" method="post">
                                 {{ method_field('DELETE') }}
                                   <button class="del-trans dropdown-item" data-id="" data-module="Del" data-controller=""
                                    ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; ลบ</button>
                                    @csrf
                                </form>
                              @endcan --}}
                              @can('edit application')
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('backend.application.edit', ['application' => $project->id]) }}" class=" edit  dropdown-item" data-id="" ><i class="fa fa-pencil-alt text-warning"></i>&nbsp;&nbsp;แก้ไข</a>
                              @endcan
                            </div>
                          </div>
                        </td>
                        <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($project->updated_at)) }}</td>
                        <td class="text-center">{{ $project->active }}</td>
                        <td class="text-left">{{ $project->application->occupation }}</td>
                        <td class="text-center">
                        @if ($project->{"image_coverpicture".substr($project->application->occupation, 0, 3).'1'})
                        <img src="{{ $project->{"image_coverpicture".substr($project->application->occupation, 0, 3).'1'} }}" class="img-table">
                        @elseif ($project->{"image_coverpicture".substr($project->application->occupation, 0, 3).'2'})
                        <img src="{{ $project->{"image_coverpicture".substr($project->application->occupation, 0, 3).'2'} }}" class="img-table">
                        @elseif ($project->{"image_coverpicture".substr($project->application->occupation, 0, 3).'3'})
                        <img src="{{ $project->{"image_coverpicture".substr($project->application->occupation, 0, 3).'3'} }}" class="img-table">
                        @else

                        @endif
                        </td>
                        <td class="text-left">{{ $project->title }}</td>
                        <td class="text-left">{{ ($project->technique_other) ? $project->technique_other : $project->technique }}</td>
                        <td class="text-left">{{ $project->application->fullname }}</td>
                        <td class="text-center"><img src="{{ $project->application->{"profile_picture".substr($project->application->occupation, 0, 3)} ?? '' }}" class="img-table"></td>
                        <td class="text-left">{{ $project->application->organization }}</td>
                        <td class="text-left">{{ $project->application->country }}</td>
                        <td class="text-left">{{ $project->application->mobile }}</td>
                        <td class="text-left">{{ $project->application->email }}</td>
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

        )
    ); ?>

  <script>
    var colum_width = '<?php echo $colum_width; ?>';
  </script>

