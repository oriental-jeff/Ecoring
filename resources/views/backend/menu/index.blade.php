@extends('backend.layouts.header', [
  'script' => [
    'treeview' => true,
    'gritter' => true,
  ],
  'css'    => [
    'treeview' => true,
    'gritter' => true,
  ] ,    
])
@section('title')
	หน้าเมนู
@endsection
@section('content')
	<div class="col-lg-12 col-md-12">
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Menu
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
          </div>
        </h4>
      </div>

      <div class="panel-body">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <!-- <div>  <label class=" col-form-label mt-2">สิทธิ์การใช้งาน:</label></div> -->
              <div id="menu">
                <ul>
                  @foreach ($menus->toArray() as $key => $menu) 
                    <li id="{{ $menu['id'] }}" 
                    data-jstree='{"icon":"fa fa-folder text-success fa-lg"}'
                    > <a href="#" class="edit" id="{{$menu['id']}}">{{Str::of($menu['name_th'])->ucfirst()}} <span class='fas fa-pencil-alt text-warning'></span></a>
                      <ul> 
                        @if(collect($menu['childrens'])->count() > 0)
                          @foreach ($menu['childrens'] as $child)
                            <li id="{{$child['id']}}" ><a href="#" class="edit" id="{{$child['id']}}">{{Str::of($child['name_th'])->ucfirst()}}  <span class='fas fa-pencil-alt text-warning'></span></a>
                              @if(collect($child['childrens'])->count() > 0)
                                <ul>
                                  @foreach ($child['childrens'] as $childen)
                                    <li id="{{$childen['id']}}" >
                                      <a href="#">{{Str::of($childen['name_th'])->ucfirst()}}</a>
                                    </li>
                                   @endforeach
                                </ul>
                              @endif
                            </li>
                          @endforeach
                        @endif
                      </ul>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>

            <div class="col-md-6 border-l mt-2">
              <form id="form-validate">
                <input type="hidden" name="id" id="id" value="">
                <div class="card edit-name bg-silver" style="display:none;">
                  <div class="card-body">
                    <h5 class="card-title">แก้ไขเมนู</h5>
                    <div class="row">
                      <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                        <label class="col-form-label" for="name_th">ชื่อเมนู (ไทย) <span class="text-danger"> * </span> : </label>
                        <input type="text" class="form-control" id="name_th" name="name_th" value="{{  old('name_th') ?? '' }}" required="" />
                        {{ $errors->first('name_th') }}
                      </div>

                      <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                        <label class="col-form-label" for="name_en">ชื่อเมนู (อังกฤษ) <span class="text-danger"> * </span> : </label>
                        <input type="text" class="form-control" id="name_en" name="name_en" value="{{  old('name_en') ?? '' }}" required="" />
                        {{ $errors->first('name_en') }}
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                      <div class="col-12 text-left">
                        <button type="submit" class="btn btn-white save"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
                        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i> ล้างข้อมูล</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
  
        </div><!-- col6 -->

      </div>
    </div>
  </div>  
  <div style='display:none;'>
    <a href="javascript:;" id="add-without-image" class="btn btn-sm btn-info">Demo</a>
  </div>
	

@endsection
@push('after-scripts')
  <script>
    $(function () {
      
      $("#menu").jstree({
        "core": {
          "themes": {
            "responsive": false
          },
          "check_callback" : function (op, node, par, pos, more) {
            if(more && more.dnd) {
              return more.pos !== "i" && par.id == node.parent;
            }
            //console.log('position: '+pos + ' node id: ' +node.id+' parent id: '+par.id + ' oparate: '+par)
            return true;

          },
        },
        "plugins" : [ "themes", "html_data", "dnd", 'state' ]
      });

      $(document).on('dnd_stop.vakata', function (e, data) {
        setTimeout(function(){
          var json = $("#menu").jstree(true).get_json();
          $.ajax({
            url: '{!! route("backend.menu.change_position") !!}',
            type: 'POST',
            dataType: 'html',
            data: {
              '_token'   : '{!!csrf_token()!!}',
              'data' : json, 
            },
          })
          .done(function(e) {
            console.log(e);
            $('#add-without-image').click();
          })
        }, 100);
      });

      $('#add-without-image').click(function(){
        $.gritter.add({
          title: '<i class="fas fa-check text-success fa-lg"> </i> แก้ไขเมนูเสร็จสมบูรณ์',
          text: '',
          //class_name: 'gritter-light'
        });
        return false;
      });

      $(document).on('click','.edit',function(){
        $('.edit-name').show();
        var id = $(this).attr('id');
        $.ajax({
          url: '{!! route("backend.menu.edit_name") !!}',
          type: 'get',
          dataType: 'json',
          data: {id: id},
        })
        .done(function(e) {

          $('#id').val(e.id);
          $('#name_th').val(e.name_th);
          $('#name_en').val(e.name_en);
          $('#menu_name_th').html('แก้ไขเมนู: '+e.name_th)
          //console.log(e);
        })
       
      });

      $('#form-validate').validate({
        submitHandler: function(form) {
          $.ajax({
            url: '{!! route("backend.menu.update_name") !!}',
            type: 'post',
            dataType: 'json',
            data: {
              _token   : '{!!csrf_token()!!}',
              id       : $('#id').val(),
              name_th  : $('#name_th').val(),
              name_en  : $('#name_en').val(),
            },
          })
          .done(function(e) {
            $("#menu").jstree('set_text',e.id,e.name_th);
            $('#add-without-image').click();
            $('.edit-name').hide();
          })
          .fail(function() {
            console.log("error");
          });
        }
      }); 

    }); //close $function


  </script>
@endpush
