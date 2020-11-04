<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
    rel="stylesheet" />

<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <input type="hidden" id="id" name="id" value="{{ $promotion_condition->id ?? '' }}">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2">
                <h5>เลือกโปรโมชั่น <span class="text-danger"> * </span>:</h5>
                <select id="promotions_id" name="promotions_id" class="form-control"
                    {{ (request()->route()->getActionMethod() == 'create') ? 'required' : 'disabled' }}>
                    @foreach ($promotions as $promotion)
                    @php
                    $tPC = [];
                    $tPCArrIdx = [];
                    @endphp
                    <option value="{{ $promotion->id }}"
                        data-tpcArr="{{ $promotion->promotion_conditions->pluck('promotion_types_id') }}"
                        {{ !($promotion_condition->promotions_id) ? '' : ($promotion_condition->promotions_id === $promotion->id ? 'selected' : '') }}
                        start_end_at="{{ date_format(date_create($promotion->start_at), 'd/m/Y') . ' - ' . date_format(date_create($promotion->end_at), 'd/m/Y') }}">
                        {{ $promotion->name_th }}</option>
                    {{-- <option value=" {{ $promotion->id }}" tPC="{{ $promotion->promotion_conditions }}"
                    data-tpcArr="{{ json_encode($tPCArrIdx) }}"
                    {{ !($promotion_condition->promotions_id) ? '' : ($promotion_condition->promotions_id === $promotion->id ? 'selected' : '') }}
                    start_end_at="{{ date_format(date_create($promotion->start_at), 'd/m/Y') . ' - ' . date_format(date_create($promotion->end_at), 'd/m/Y') }}">
                    {{ $promotion->name_th }}</option> --}}
                    @endforeach
                </select>
                {{ $errors->first('name_th') }}
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label">เงื่อนไข :</label>
                <div class="alert alert-primary" role="alert" style="position: relative; top: 25px; height: 35px;">
                    <div id="date_cond" style="height: 25px; margin-top: 6px;"></div>
                </div>
            </div>
        </div>
        <div class="form-row" style="margin-top: 25px">
            <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                <h5>ข้อมูลสินค้า <span class="text-danger"> * </span>:</h5>
                <div class="form-row form-disable"
                    style="background-color: lightgoldenrodyellow; padding: 8px; border-radius: 10px;">
                    <div class="form-group col-12">
                        <label for="filter_tags">เลือกตัวกรอง "Tags"</label>
                        <select name="filter_tags[]" id="filter_tags" class='form-control select-2' multiple="multiple">
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
                                <div class="input-group-append" data-target="#dtstart_at" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                            <label class="col-form-label" for="end_at">&nbsp;</label>
                            <div class="input-group date" id="dtend_at" data-target-input="nearest">
                                <input type="text" class="form-control datepicker-enddate valid" id="end_at"
                                    name="end_at" value="" />
                                <div class="input-group-append" data-target="#dtend_at" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class='mt-4 offset-4 col-2 text-right'>
                            <button type="button" class="btn btn-white btn-search w-100" id="search"><i
                                    class='fas fa-search text-info'></i> ค้นหา</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-disable" style="min-width: 980px; margin: 0 auto; position: relative">
                    <table id="tblProducts" class="display table table-striped table-bordered w-100 nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>วันที่นำเข้าสินค้า</th>
                                <th>รูป</th>
                                <th>ชื่อเรียก</th>
                                <th>Code</th>
                                <th>SKU</th>
                                <th>ส่วนลด (บาท)</th>
                                <th>ส่วนลด (%)</th>
                                <th>หมวดหมู่</th>
                                <th>Tags</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-row" style="margin-top: 25px">
            <div class="col-xl-3 col-md-3 col-sm-12 mt-2">
                <h5>รูปแบบโปรโมชั่น:</h5>
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-2">
                        <label for="promotion_pattern">เลือกรูปแบบ <span class="text-danger"> * </span></label>
                        <select name="promotion_pattern" id="promotion_pattern" class='form-control select-2'
                            {{ (request()->route()->getActionMethod() == 'create') ? 'required' : 'disabled' }}>
                            @foreach ($promotion_types as $promotion_type)
                            <option value="{{ $promotion_type->id }}">
                                {{ $promotion_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="offset-md-1 col-xl-8 col-md-8 col-sm-12 mt-2 promotion-form">
                <h5>แบบฟอร์มโปรโมชั่น:</h5>
                <div class="main-tags-form">
                    @php
                    if (empty($pcds)){ $pcds = [0]; }
                    @endphp
                    @foreach ($pcds as $k => $v)
                    {!! $k == 0 ? '<div class="multi-blogs">' : '' !!}
                        <div class="row tags-form">
                            <input type="hidden" name="cdt[{{ $k ?? 0 }}][promotion_condition_details_id]"
                                value="{{ $v->promotion_condition_details_id ?? '' }}">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 input_number block">
                                <label class="col-form-label form-inline text-condition" for="condition">จำนวน
                                    (ชิ้น) <span class="text-danger"> * </span></label>
                                <input type="number" min="0" class="form-control" name="cdt[{{ $k ?? 0 }}][condition]"
                                    value="{{ $v->condition ?? '' }}" required="" />
                                {{ $errors->first('condition') }}
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label text-discount" for="discount">ส่วนลด (บาท) <span
                                        class="text-danger"> * </span></label>
                                <input type="number" min="0" step="any" class="form-control"
                                    name="cdt[{{ $k ?? 0 }}][discount]" value="{{ $v->discount ?? '' }}" required="" />
                                {{ $errors->first('discount') }}
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label text-discount_pc" for="discount_pc">ส่วนลด (%) <span
                                        class="text-danger"> * </span></label>
                                <input type="number" min="0" step="any" class="form-control"
                                    name="cdt[{{ $k ?? 0 }}][discount_pc]" value="{{ $v->discount_pc ?? '' }}"
                                    required="" />
                                {{ $errors->first('discount_pc') }}
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label form-inline delete-ctrl">ลบ</label>
                                <a href="javascript:void(0);" class="delete-more delete-ctrl btn btn-white"><i
                                        class="fas fa-trash text-danger"></i></a>
                            </div>
                        </div>
                        {!! $k == 0 ? '</div>' : '' !!}
                    @endforeach
                    <div id="newRow"></div>
                    <div class="row btn-add-opt block">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 ml-1">
                            <button type="button" class='btn btn-success add-more'> <i class='fas fa-plus'></i>
                                เพิ่มเงื่อนไข</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-packs-form">

            </div>
        </div>
    </div>
    <input type="hidden" name="cdtDel" value="{{ $pcds }}">
    <input type="hidden" name="dtDel" value="{{ $pds }}">
</div>
<hr>
<div class="form-group row mt-2">
    <div class="col-12 text-left">
        <button type="submit" class="btn btn-white btn-submit"><i class="fa fa-save text-success"></i>
            บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-white reset"><i class="fas fa-eraser text-warning"></i>
            ล้างข้อมูล</button>
        <button type="button" class="btn btn-white back" value="{{  url()->previous() }}"><i
                class="fas fa-reply text-danger"></i> ย้อนกลับ</button>
    </div>
</div>

@php
$tags = !empty($product_tags) ? $product_tags->pluck('filter_tags')->toJson() : '';
$pds = !empty($pds) ? $pds->toJson() : '' ;
$promotion_types_id = !empty($promotion_condition) ? $promotion_condition->promotion_types_id : '' ;
$promotion_types = $promotion_types ? $promotion_types->toJson() : '' ;
$getActionMethod = request()->route()->getActionMethod();
@endphp

@push('after-scripts')
<script type="text/javascript"
    src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script>
    var pds = '{!! $pds ?? [] !!}';
    var pdsChecked = [];
    $.parseJSON(pds).forEach(e => {
        pdsChecked.push(e.id);
    });
    var jsonData = {};
    var pd_type = '{!! $promotion_types_id ?? 1 !!}';
    var getActionMethod = '{!! $getActionMethod !!}';
    var pmts = '{!! $promotion_types ?? [] !!}';

    $(function(){
        var tags = '{!! $tags !!}';
        $('#filter_tags').select2();
        if(tags != '') {
            $('#filter_tags').val($.parseJSON(tags)).trigger('change');
        }

        $('#promotions_id').on('change', function() {
            ctrlConditionsPattern($(this));
        });

        var table = $('#tblProducts').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'<'float-right'B><'toolbar float-right'>>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    text: 'ใช้กับทั้งหมด',
                    action: function ( e, dt, node, config ) {
                        dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                            var data = this.data();
                            data.discount = $('#discount_all').val();
                            data.discount_pc = $('#discount_pc_all').val();
                            this.invalidate();
                        } );
                    }
                }
            ],
            serverSide: true,
            processing: true,
            ajax: {
                url: base_url + '/backend/product/promotion',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function ( data ) {
                    data.id = $('#id').val();
                    data.filter_tags = $('#filter_tags').val();
                    data.start_at = $('#start_at').val();
                    data.end_at = $('#end_at').val();
                },
                dataType: 'json',
            },
            columnDefs: [
                {
                    targets: 0,
                    data: function ( data, type, full, meta ) {
                        return meta.row;
                    },
                    class: 'text-center',
                    checkboxes: {
                        selectRow: true
                    }
                },
                { data: 'created_at', targets: 1 },
                { data: 'image', targets: 2, class: 'text-center' },
                { data: 'name_th', targets: 3 },
                { data: 'code', targets: 4 },
                { data: 'sku', targets: 5 },
                { data: 'discount', render: function ( data, type, row ) {
                    return `<input type="number" min="0" value="${row.discount}" id="discount${row.id}" name="discount${row.id}"
                    class="form-control discount">`;
                }, targets: 6, orderable: false },
                { data: 'discount_pc', render: function ( data, type, row ) {
                    return `<input type="number" min="0" value="${row.discount_pc}" id="discount_pc${row.id}" name="discount_pc${row.id}"
                    class="form-control discount_pc">`;
                }, targets: 7, orderable: false },
                { data: 'categorie', targets: 8 },
                { data: 'tags', targets: 9 },
            ],
            pageLength: 100,
            select: {
                style: 'multi'
            },
            order: [[1, 'asc']],
            rowCallback: function(row, data, dataIndex){
                // Get row ID
                var rowId = data.id;

                // If row ID is in the list of selected row IDs
                if($.inArray(rowId, pdsChecked) !== -1){
                    table.cell(row, 0).checkboxes.select();
                }
            },
            initComplete: function(settings, json) {
                $('div.toolbar').html(`
                <div class="form-inline">
                    <input type="number" min="0" id="discount_all" name="discount_all" placeholder="ส่วนลด (บาท)" class="form-control mr-2">
                    <input type="number" min="0" id="discount_pc_all" name="discount_pc_all" placeholder="ส่วนลด (%)" class="form-control mr-2">
                </div>
                `);
            },
        });

        // $('#tblProducts').on('change', 'input[type=number]', function () {
        //     //Get the cell of the input
        //     var cell = $(this).closest('td');

        //     //update the value
        //     $(this).attr('value', $(this).val());

        //     //invalidate the DT cache
        //     table.cell($(cell)).invalidate();
        // });

        $('#search').on('click', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });

        $('.btn-submit').on('click', function(e) {
            // checked validate
            var form = this;
            var rows_selected = table.column(0).checkboxes.selected();

            if (rows_selected.length == 0) {
                swal({
                    title: 'โปรดเลือก สินค้า อย่างน้อย 1 รายการ',
                    icon: "warning",
                    dangerMode: true,
                });
                return false;
            }

            // Prepare all data selected checkboxes
            $.each(rows_selected, function(index, rowIdx){
                // Create a hidden element
                var d = table.row(rowIdx).data();
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'dt['+rowIdx+'][id]')
                        .val(d.id)
                );
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'dt['+rowIdx+'][discount]')
                        .val($('#discount'+d.id).val())
                );
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'dt['+rowIdx+'][discount_pc]')
                        .val($('#discount_pc'+d.id).val())
                );
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'dt['+rowIdx+'][promotion_details_id]')
                        .val(d.promotion_details_id)
                );
            });
        });

        // clone pattern of conditions
        var clonedPattern = $('.multi-blogs');
        $('.multi-blogs .delete-ctrl').hide();

        $('#promotion_pattern').on('change', function() {
            checkConditionsPattern($(this));
        });

        var iArr = pdsChecked.length-1;
        $('#promotion_pattern').val(pd_type);
        checkConditionsPattern($('#promotion_pattern'), true);
        ctrlConditionsPattern($('#promotions_id'));

        $('.add-more').on('click', function(e) {
            iArr ++;
            e.preventDefault();
            $('#newRow').append(clonedPattern.html());
            $('#newRow').find('.tags-form:last').find('input').eq(0).val('').attr('name', 'cdt['+iArr +'][promotion_condition_details_id]');
            $('#newRow').find('.tags-form:last').find('input').eq(1).val('').attr('name', 'cdt['+iArr +'][condition]');
            $('#newRow').find('.tags-form:last').find('input').eq(2).val('').attr('name', 'cdt['+iArr +'][discount]');
            $('#newRow').find('.tags-form:last').find('input').eq(3).val('').attr('name', 'cdt['+iArr +'][discount_pc]');
            $('#newRow .delete-ctrl').show();
        });

        $(document).on('click','.delete-more', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove()
        });
    });
    function ctrlConditionsPattern(e) {
        // display type
        let dpt = '';
        if ($('option:selected', e).data('tpcArr') != "[]") {
            JSON.parse($('option:selected', e).attr('data-tpcArr')).forEach(e => {
                if (dpt) dpt += ', ';
                dpt += $.parseJSON(pmts).find(x => x.id == e).name;
            });
        }
        $('#date_cond').html('ช่วงเวลา: ' + $('option:selected', e).attr('start_end_at') + ', รูปแบบที่ใช้แล้ว: (' +
        (dpt ? dpt : '-') + ')');

        if (getActionMethod == 'create') {
            let setChecked = false, newVal = '';
            $( "#promotion_pattern option" ).each(function( index ) {
                let matchedCDT = $('option:selected', e).attr('data-tpcArr').includes($(this).val());
                $(this).prop('disabled', matchedCDT);
                if (setChecked == false && matchedCDT == false) {
                    newVal = $(this).val();
                    setChecked = true;
                }
            });
            $('#promotion_pattern').val(newVal);
        }
        checkConditionsPattern($('#promotion_pattern'), true);
    }
    function checkConditionsPattern(e, ftOpt=false) { // ftOpt = First time option -> 0:false|1:true
        $('.promotion-form').hide();
        $('.main-tags-form').find('input').prop('disabled', false);

        // Control text input on table
        if (!ftOpt) {
            $('#tblProducts').find('input[type=number]').val('');
            $('#discount_all').val('');
            $('#discount_pc_all').val('');
            $('.main-tags-form').find('input[type=number]').val('');
        }
        // $('#tblProducts').find('input[type=number]').prop('disabled', true);
        $('#discount_all').prop('disabled', true);
        $('#discount_pc_all').prop('disabled', true);

        // Control Autofill button
        $('#tblProducts_wrapper').find('.dt-buttons a').addClass('disabled');

        if (e.val() == '2') {
            $('.main-tags-form').find('input').prop('disabled', true);
            $('#tblProducts_wrapper').find('.dt-buttons a').removeClass('disabled');
            // $('#tblProducts').find('input[type=number]').prop('disabled', false);
            $('#discount_all').prop('disabled', false);
            $('#discount_pc_all').prop('disabled', false);
        } else if (e.val() == '3') {
            $('.text-condition').text('จำนวน (เงิน)');
            $('.text-discount').text('ส่วนลด (บาท)');
            $('.promotion-form').show();
        } else {
            $('.text-condition').text('จำนวน (ชิ้น)');
            $('.text-discount').text('ส่วนลด (บาท)');
            $('.promotion-form').show();
        }
    }
</script>
@endpush
