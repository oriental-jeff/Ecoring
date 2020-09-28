<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <h5>เลือกโปรโมชั่น <span class="text-danger"> * </span>:</h5>
                <select id="promotions_id" name="promotions_id" class="form-control" required>
                    @foreach ($promotions as $promotion)
                    <option value="{{ $promotion->id }}"
                        start_end_at="{{ date_format(date_create($promotion->start_at), 'd/m/Y') . ' - ' . date_format(date_create($promotion->end_at), 'd/m/Y') }}"
                        {{ $promotion_details->promotion_id === $promotion->id ? 'selected' : '' }}>
                        {{ $promotion->name_th }}</option>
                    @endforeach
                </select>
                {{ $errors->first('name_th') }}
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                <label class="col-form-label">เงื่อนไข :</label>
                <div class="alert alert-primary" role="alert" style="position: relative; top: 25px; height: 35px;">
                    <div id="date_cond" style="height: 25px; margin-top: 6px;">
                        {{ date_format(date_create($promotions[0]->start_at), 'd/m/Y') . ' - ' . date_format(date_create($promotions[0]->end_at), 'd/m/Y') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row" style="margin-top: 25px">
            <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                <h5>ข้อมูลสินค้า <span class="text-danger"> * </span>:</h5>
                <div class="card border">
                    <div class="card-body">
                        <div class="row form-silde">
                            <div class='mt-2 mr-2'>
                                <!-- {{-- <a href="#" class="slide-delete btn btn-white"><i class='fas fa-tresh text-danger'></i></a> --}} -->
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-12">
                                <label class='col-form-label' for="products_id">เลือกสินค้า <span class='text-danger'> *
                                    </span> : </label>
                                <select name="products_id[]" class='form-control' required>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name_th }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-2 col-md-12 col-sm-12">
                                <label class='col-form-label ' for="static_type">ราคา <span class='text-danger'>
                                        * </span> : </label>
                                <input type="number" min="0" step="any" name='price[]' class='form-control mt-2'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="return-slide"></div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <button class='btn btn-success add-slide'> <i class='fas fa-plus'></i>
                    เพิ่มสินค้า</button>
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


@push('after-scripts')
<script>
    $(function(){
        $('#promotions_id').on('change', function() {
            $('#date_cond').html($('option:selected', this).attr('start_end_at'));
        });
        $('.add-slide').on('click', function(e){
            e.preventDefault();
            var form_slide =
                `<div class="card border">
                    <div class="card-body">
                        <div class="row form-silde">
                            <div class="mt-2 mr-2">
                                <a href="#" class="slide-delete btn btn-white"><i class="fas fa-trash text-danger"></i></a>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-12">
                                <label class='col-form-label' for="products_id">เลือกสินค้า <span class='text-danger'> *
                                    </span> : </label>
                                <select name="products_id[]" class='form-control' required>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name_th }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-2 col-md-12 col-sm-12">
                                <label class='col-form-label ' for="static_type">ราคา <span class='text-danger'>
                                        * </span> : </label>
                                <input type="number" min="0" step="any" name='price[]' class='form-control mt-2'>
                            </div>
                        </div>
                    </div>
                </div>`;
            $('.return-slide').append(form_slide);
        });
    });

    $(document).on('click','.slide-delete', function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().parent().remove();
    });
</script>
@endpush
