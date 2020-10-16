<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
    rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <h5>เลือกโปรโมชั่น <span class="text-danger"> * </span>:</h5>
                <select id="promotions_id" name="promotions_id" class="form-control"
                  {{ (request()->route()->getActionMethod() == 'create') ? 'required' : 'disabled' }}>
                  <option value="">กรุณาระบุ</option>
                  @foreach ($promotions as $promotion)
                    @if (request()->route()->getActionMethod() == 'create')
                      <option value="{{ $promotion->id }}"
                        start_end_at="{{ date_format(date_create($promotion->start_at), 'd/m/Y') . ' - ' . date_format(date_create($promotion->end_at), 'd/m/Y') }}">
                        {{ $promotion->name_th }}</option>
                    @else
                      <option value="{{ $promotion->id }}"
                        start_end_at="{{ date_format(date_create($promotion->start_at), 'd/m/Y') . ' - ' . date_format(date_create($promotion->end_at), 'd/m/Y') }}"
                        {{ $promotion_detail->promotion_id === $promotion->id ? 'selected' : '' }}>
                        {{ $promotion->name_th }}</option>
                    @endif
                  @endforeach
                </select>
                {{ $errors->first('name_th') }}
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label">เงื่อนไข :</label>
                <div class="alert alert-primary" role="alert" style="position: relative; top: 25px; height: 35px;">
                    <div id="date_cond" style="height: 25px; margin-top: 6px;">
                      @if (!empty($promotions[0]))
                        {{ date_format(date_create($promotions[0]->start_at), 'd/m/Y') . ' - ' . date_format(date_create($promotions[0]->end_at), 'd/m/Y') }}
                      @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row" style="margin-top: 25px">
            <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                <h5>ข้อมูลสินค้า <span class="text-danger"> * </span>:</h5>
                <form id="" action="{{ route('backend.promotion_details.index') }}" method='post'
                    data-parsley-validate="true">
                    @method('get')
                    @csrf
                    <div class="form-row"
                        style="background-color: lightgoldenrodyellow; padding: 8px; border-radius: 10px;">
                        <div class="form-group col-12">
                            <label for="filter_tags">เลือกตัวกรอง "Tags"</label>
                            <select name="filter_tags[]" id="filter_tags" class='form-control select-2'
                                multiple="multiple">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name_th }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row col-12">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                                <label class="col-form-label" for="start_at">เลือกตัวกรอง "วันที่นำเข้าสินค้า"</label>
                                <div class="input-group date" id="dtstart_at" data-target-input="nearest">
                                    <input type="text" class="form-control datepicker-startdate valid" id="start_at" />
                                    <div class="input-group-append" data-target="#dtstart_at"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                {{ $errors->first('start_at') }}
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                                <label class="col-form-label" for="end_at">&nbsp;</label>
                                <div class="input-group date" id="dtend_at" data-target-input="nearest">
                                    <input type="text" class="form-control datepicker-enddate valid" id="end_at"
                                        name="end_at" value="" />
                                    <div class="input-group-append" data-target="#dtend_at"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                {{ $errors->first('end_at') }}
                            </div>
                            <div class='mt-4 offset-4 col-2 text-right'>
                                <button type="submit" class="btn btn-white btn-search w-100" id="search"><i
                                        class='fas fa-search text-info'></i> ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                                    <form id="frm-example" action="/path/to/your/script.php" method="POST">

                                        <table id="example"
                                            class="display table table-striped table-bordered w-100 nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>วันที่นำเข้าสินค้า</th>
                                                    <th>รูป</th>
                                                    <th>ชื่อเรียก</th>
                                                    <th>SKU</th>
                                                    <th>หมวดหมู่</th>
                                                    <th>Tags</th>
                                                    {{-- <th>ราคา</th> --}}
                                                </tr>
                                            </thead>
                                            {{-- <tbody>
                                                @if(!empty($products))
                                                @foreach($products as $product)
                                                <tr class="del">
                                                    <td class="text-center"></td>
                                                    <td class="text-center">
                                                        {{ date('d/m/Y H:i:s', strtotime($product->created_at)) }}</td>
                                            <td class="text-center"><img src="{{ $product->image ?? '' }}"
                                                    class="img-table"></td>
                                            <td class="text-left">{{ $product->name_th }}</td>
                                            <td class="text-left">{{ $product->sku }}</td>
                                            <td class="text-center">
                                                {{ $product->categories_name->name_th ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            </tbody> --}}
                                        </table>

                                        {{-- <hr>

                                        <p>Press <b>Submit</b> and check console for URL-encoded form data that would be
                                            submitted.</p>

                                        <p><button>Submit</button></p>

                                        <p><b>Selected rows data:</b></p>
                                        <pre id="example-console-rows"></pre>

                                        <p><b>Form data as submitted to the server:</b></p>
                                        <pre id="example-console-form"></pre> --}}

                                    </form>
                                </div>
                                <!-- end panel-body -->
                            </div>
                            <!-- end panel -->
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <div class="form-row" style="margin-top: 25px">
            <div class="col-xl-3 col-md-3 col-sm-12 mt-2">
                <h5>รูปแบบโปรโมชั่น <span class="text-danger"> * </span>:</h5>
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-2">
                        <label for="promotion_pattern">เลือกรูปแบบโปรโมชั่น</label>
                        <select name="promotion_pattern" id="promotion_pattern" class='form-control select-2'>
                            <option value="tags">แบบขั้นบันได</option>
                            <option value="packs">จับคู่สินค้า (แพ็ค)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="offset-1 col-xl-8 col-md-8 col-sm-12 mt-2">
                <h5>แบบฟอร์มโปรโมชั่น <span class="text-danger"> * </span>:</h5>
                <div class="main-tags-form">
                    <div class="row tags-form">
                        <div class="row col-xl-8 col-lg-8 col-md-12 col-sm-12 mt-2">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 input_number block">
                                <label class="col-form-label form-inline" for="name_th">จำนวน <span class="text-danger">
                                        *
                                    </span>
                                    :
                                </label>
                                <input type="number" class="form-control" id="name_th" name="name_th" value=""
                                    required="" />
                                {{ $errors->first('name_th') }}
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label" for="name_en">ราคา <span class="text-danger"> *
                                    </span> :
                                </label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value=""
                                    required="" />
                                {{ $errors->first('name_en') }}
                            </div>
                        </div>
                    </div>
                    <div class="row btn-add-opt block">
                        @if (request()->route()->getActionMethod() === 'create')
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 ml-1">
                            <button class='btn btn-success add-slide'> <i class='fas fa-plus'></i>
                                เพิ่มเงื่อนไข</button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="main-packs-form">

                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-group row mt-2">
    <div class="col-12 text-left">
        <button type="submit" class="btn btn-white"><i class="fa fa-save text-success"></i> บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i> ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>

@if(!empty($product_tags))
@php
$tags = $product_tags->pluck('filter_tags')->toJson();
@endphp
@else
@php
$tags = '';
@endphp
@endif

@push('after-scripts')
<script type="text/javascript"
    src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script>
    $(function(){
        var tags = '{!! $tags !!}';
        console.log(tags);
        $('#filter_tags').select2();
        if(tags != '') {
            $('#filter_tags').val($.parseJSON(tags)).trigger('change');
        }

        $('#promotions_id').on('change', function() {
            $('#date_cond').html($('option:selected', this).attr('start_end_at'));
        });

        var table = $('#example').DataTable({
            // dom: 'tlibl',
            ajax: {
                url: base_url + '/backend/product/promotion',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
            },
            columnDefs: [
                {
                    targets: 0,
                    data: 'id',
                    class: 'text-center',
                    checkboxes: {
                        selectRow: true
                    }
                },
                { data: 'created_at', targets: 1 },
                { data: 'image', targets: 2, class: 'text-center' },
                { data: 'name_th', targets: 3 },
                { data: 'sku', targets: 4 },
                { data: 'categorie', targets: 5 },
                { data: 'tags', targets: 6 },
            ],
            pageLength: 100,
            select: {
                style: 'multi'
            },
            order: [[1, 'asc']]
        });


        // Handle form submission event
        $('#frm-example').on('submit', function(e){
            var form = this;

            var rows_selected = table.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId){
                // Create a hidden element
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });
        });

        $('#promotion_pattern').on('change', function() {
            $('.tags-form .input_number').toggle();
            $('.btn-add-opt').toggle();
        });

        $('.add-slide').on('click', function() {
            var n = $('.tags-form').eq(0).html();
            $('.tags-form').eq(0).append(n);
        });
    });

    // $(document).on('click','.slide-delete', function(e) {
    //     e.preventDefault();
    //     $(this).parent().parent().parent().parent().remove();
    // });
</script>
@endpush
