@extends('layouts.header', [
                            'script' => ['dashboard' => true, 'calendar' => true],
                            'css'    => ['dashboard' => true, 'calendar' => true]
                            ]
        )
@section('title')
	Dashboard
@endsection
@section('content')
<style>
.fc-sat { color:blue; }
.fc-sun { color:red;  }
</style>
	<div class="row">
    <div class="col-xl-3 col-md-6">
      <div class="widget widget-stats bg-blue">
        <div class="stats-icon">
          <i class="fa fa-desktop"></i>
        </div>
        <div class="stats-info">
          <h4>Total Work</h4>
          <p>{{ number_format($worktime->times) ?? 0 }} Min</p>
        </div>
        <div class="stats-link">
          <a href="{{ url('workday') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6">
      <div class="widget widget-stats bg-info">
        <div class="stats-icon">
          <i class="fa fa-desktop"></i>
        </div>
        <div class="stats-info">
          <h4>Work Time</h4>
          <p>{{  0 }} Min</p>
        </div>
        <div class="stats-link">
          <a href="{{ url('leaveday') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6">
      <div class="widget widget-stats bg-orange">
        <div class="stats-icon">
          <i class="fa fa-clock"></i>
        </div>
        <div class="stats-info">
          <h4>Total Time Late</h4>
          <p>{{ number_format($timestamp->late) ?? 0 }} Min</p>
        </div>
        <div class="stats-link">
          <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6">
      <div class="widget widget-stats bg-red">
        <div class="stats-icon">
          <i class="fa fa-wheelchair"></i>
        </div>
        <div class="stats-info">
          <h4>Total Leave</h4>
          <p>{{ number_format($leave->stop) ?? 0 }} Min</p>
        </div>
        <div class="stats-link">
          <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>

  <div class="col-lg-8 col-md-12">
    <div class="panel panel-inverse">
       <div class="panel-heading">
         <h4 class="panel-title">Project Time(Min) 
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
          </h4>
       </div>
       <div class="panel-body">
         <div id="nv-bar-chart" class="height-sm"></div>
       </div>
     </div>
   </div> 

    <div class="col-lg-4 col-md-12">
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <h4 class="panel-title">Projec Time(Min)
            <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
          </h4>
        </div>
        <div class="panel-body">
          <div id="nv-donut-chart" class="height-sm"></div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-12">
      <div class="panel panel-inverse">
        <div class="panel-heading">
        <h4 class="panel-title">Late(Min)
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
          </h4>
        </div>
        <div class="panel-body">
          <div id="nv-donut-late" class="height-sm"></div>
        </div>
      </div>
    </div>

     <div class="col-lg-4 col-md-12">
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <h4 class="panel-title">Leave(Min)
            <div class="panel-heading-btn">
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
          </h4>
        </div>
        <div class="panel-body">
          <div id="nv-donut-leave" class="height-sm"></div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-12">
      <div class="panel panel-inverse" >
        <div class="panel-heading">
          <h4 class="panel-title">Calendar
             <div class="panel-heading-btn">     
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
          </h4>
        </div>
        <div class="panel-body">
          <div id="calendar" class="datepicker-full-width  position-relative">
          </div>
        </div>
      </div>
    </div>
  

	</div>
  <!-- end row -->


<script>
  var donut = '{!! $data['projects_donut'] !!}';
  var bar = '{!! $data['projects_donut'] !!}';
  var leave = '{!! $data['leave_pie'] !!}';
  var late = '{!! $data['late_pie'] !!}';
  var holiday = '{!! $data['holiday'] !!}';
  console.log(holiday);
</script>


</script>

	 
	 



	

@endsection


