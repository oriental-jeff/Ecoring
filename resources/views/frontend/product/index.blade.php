@extends('frontend.layouts.main')
@push('after-css')
  <link href="{{ asset('css/frontend/product.css?v') . time() }}" rel="stylesheet" />
  <!-- Range slider style -->
  <link href="{{ asset('plugins/rangeslider/d3RangeSlider.css') }}" rel="stylesheet" />
@endpush
@section('title')
@endsection

@section('content')
  <!-- begin #content -->
  <div id="content" class="content">
    <section class="box-breadcrumb d-none d-md-block">
			<div class="container">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="{{ route('frontend.home', ['locale' => get_lang()]) }}">Home</a></li>
				    <li class="breadcrumb-item active" aria-current="page">{{ $pages->{get_lang('title')} }}</li>
				  </ol>
				</nav>
			</div>
    </section>
	        
    <section class="box-products mt-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
						<div class="b-sticky d-none d-lg-block">
							<form id="form_search_product" class="form-Search" action="{{ route('frontend.product', ['locale' => get_lang()]) }}" method="post">
                @method('get')
                @csrf
								<div class="form-inline">
                  <input type="text" class="form-control" name="keyword" placeholder="{{ __('messages.search_products') }}.." aria-label="Search" value="{{ request()->keyword }}">
								  <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="fa fa-search"></i></button>
                </div>

								<h5 class="mt-3">{{ __('messages.category') }}</h5>
                @php
                  $p = 0;
                  $limit_hide = 5;
                @endphp
                @foreach ($categories as $category)
                  @php
                    $p++;
                  @endphp
                  @if ($p == $limit_hide)
                    <div class="box-Toggle" style="display: none;">
                  @endif
  								<label for="category_checkbox{{ $category->id }}" class="d-block">
  									<input type="checkbox" id="category_checkbox{{ $category->id }}" name="category_selected[]" value="{{ $category->id }}" {{ (!empty(request()->category_selected) and in_array($category->id, request()->category_selected)) ? 'checked' : '' }}>
  									{{ $category->{ get_lang('name') } }}
  									<span class="float-right">({{ $category->products_count }})</span>
  								</label>
                @endforeach
                @if (count($categories) > $limit_hide)
                  </div>
                @endif
                @if (count($categories) > $limit_hide)
  								<button type="button" id="button-Toggle1" class="p-2 mt-2 border-0 w-100" onclick="$('.box-Toggle').slideToggle();$(this).hide();$('#button-Toggle2').show();">
  									{{ __('messages.show_more') }} <img src="{{ asset('images/icon-select.png') }}">
  								</button>
  								<button type="button" id="button-Toggle2" class="p-2 mt-2 border-0 w-100" style="display: none" onclick="$('.box-Toggle').slideToggle();$(this).hide();$('#button-Toggle1').show();">
  									{{ __('messages.show_less') }} <img id="button-Toggle2" src="{{ asset('images/icon-select.png') }}" style="transform: rotate(180deg);">
  								</button>
                @endif
								<hr>
								
								<h5 class="mt-3">{{ __('messages.grade') }}</h5>
                @foreach ($grades as $grade)
  								<label for="grade_checkbox{{ $grade->id }}" class="d-block">
  									<input type="checkbox" id="grade_checkbox{{ $grade->id }}" name="grade_selected[]" value="{{ $grade->id }}" {{ (!empty(request()->grade_selected) and in_array($grade->id, request()->grade_selected)) ? 'checked' : '' }}>
  									{{ $grade->{ get_lang('name') } }}
  									<span class="float-right">({{ $grade->products_count }})</span>
  								</label>
                @endforeach
								<hr>
								
								<h5 class="mt-3">{{ __('messages.price') }}</h5>
								<div class="slider-price">
								  <input type="text" id="s1" name="min_price" value="{{ $min_price_selected }}">
								  <input type="text" id="s2" name="max_price" value="{{ $min_price_selected }}">
								</div>
								<div id="slider-container" class="sliderContainer"></div>

								<hr>
								<button type="submit" class="btn border-0 w-100">{{ __('messages.search') }}</button>
                <input type="hidden" name="sort" id="sort" value="{{ empty(request()->sort) ?? '1' }}">
							</form>
						</div>
					</div>
					<div class="col-lg-9">
						<div class="row border-bottom pb-1">
							<div class="col-lg-7">
								<h5 class="my-1">{{ __('messages.product') }} <span style="font-size: 0.8em;">({{ count($products) }} {{ __('messages.list') }})</span></h5>
							</div>
							<div class="col-lg-5 d-none d-lg-block">
								<div class="dropdown show float-right">
                  <div class="col-auto my-1">
                    <label class="mr-sm-2 sr-only" for="sort_product">Preference</label>
                    <select class="custom-select mr-sm-2" id="sort_product" name="sort_product">
                      <option value="1" {{ request()->sort == '1' ? 'selected' : '' }}>{{ __('messages.sort_by_recommended') }}</option>
                      <option value="2" {{ request()->sort == '2' ? 'selected' : '' }}>{{ __('messages.sort_by_new') }}</option>
                      <option value="3" {{ request()->sort == '3' ? 'selected' : '' }}>{{ __('messages.sort_by_grade_high') }}</option>
                      <option value="4" {{ request()->sort == '4' ? 'selected' : '' }}>{{ __('messages.sort_by_grade_low') }}</option>
                      <option value="5" {{ request()->sort == '5' ? 'selected' : '' }}>{{ __('messages.sort_by_price_low') }}</option>
                      <option value="6" {{ request()->sort == '6' ? 'selected' : '' }}>{{ __('messages.sort_by_price_high') }}</option>
                    </select>
                  </div>
								</div>
							</div>
							<div class="col-12 d-block d-lg-none px-2">
								<button type="button" class="float-left" data-toggle="modal" data-target="#exampleModalLong" id="menuModal">
									<img src="{{ asset('images/filter.svg') }}">
									{{ __('messages.product_sorting') }}
									<img src="{{ asset('images/filter2.svg') }}" class="float-right mt-1">
								</button>
							</div>
						</div>
						<div class="row box-List pt-3">
              @foreach ($products as $product)
                <div class="card col-xl-3 col-lg-3 col-sm-4 col-6 list">
                  <div class="btn-heart {{ $product->favorites_count > 0 ? 'active' : '' }}" data-fav="{{ $product->favorites_count }}" data-product="{{ $product->id }}"></div>
  	              <div class="card-body">
  	                <a href="{{ route('frontend.product-detail', ['locale' => get_lang(), 'product' => $product->id]) }}">
  	                  <div class="img">
  	                    <div class="src-img" style="background-image: url({{ $product->image ?? 'http://via.placeholder.com/500x350' }})">
  	                      <img src="{{ asset('images/size-img.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
  	                    </div>
  	                  </div>
  	                  <div class="box-text">
  	                      <h6>{{ $product->{ get_lang('name') } }}</h6>
  	                      <span>{{ __('messages.grade') }} - {{ $product->grades_name->{ get_lang('name') } }}</span>
  	                  </div>
  	                </a>
  	              </div>
  	              <div class="card-footer">
  	                <span class="price">{{ __('messages.price') }} : ฿{{ number_format($product->product_price) }}<b>฿{{ number_format($product->full_price) }}</b></span>
  	                <button type="button" class="btn btn-cart w-100" {{ empty(Auth::user()) ? 'disabled' : '' }} data-product="{{ $product->id }}">{{ __('messages.add_basket') }}</button>
  	              </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
          
    <section class="box-navigation pb-4">
      <div class="container">
        {{ $products->links('frontend.layouts.paginator') }}          
      </div>
    </section>
  </div>
  <!-- end #content -->
        
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">

      <form id="form_search_product_mb" class="form-Search" action="{{ route('frontend.product', ['locale' => get_lang()]) }}" method="post">
        @method('get')
        @csrf
        <div class="form-inline">
          <input type="text" class="form-control" name="keyword" placeholder="ค้นหาสินค้า.." aria-label="Search" value="{{ request()->keyword }}">
          <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="fa fa-search"></i></button>
        </div>

        <h5 class="mt-3">{{ __('messages.sort') }}</h5>
        <div class="dropdown show w-100">
          <label class="mr-sm-2 sr-only" for="sort_product_mb">Preference</label>
          <select class="custom-select mr-sm-2" id="sort_product_mb" name="sort_product">
            <option value="1" {{ request()->sort == '1' ? 'selected' : '' }}>{{ __('messages.sort_by_recommended') }}</option>
            <option value="2" {{ request()->sort == '2' ? 'selected' : '' }}>{{ __('messages.sort_by_new') }}</option>
            <option value="3" {{ request()->sort == '3' ? 'selected' : '' }}>{{ __('messages.sort_by_grade_high') }}</option>
            <option value="4" {{ request()->sort == '4' ? 'selected' : '' }}>{{ __('messages.sort_by_grade_low') }}</option>
            <option value="5" {{ request()->sort == '5' ? 'selected' : '' }}>{{ __('messages.sort_by_price_low') }}</option>
            <option value="6" {{ request()->sort == '6' ? 'selected' : '' }}>{{ __('messages.sort_by_price_high') }}</option>
          </select>
        </div>

        <h5 class="mt-3">{{ __('messages.category') }}</h5>
        @foreach ($categories as $category)
          <label for="m_category_checkbox{{ $category->id }}" class="d-block">
            <input type="checkbox" id="m_category_checkbox{{ $category->id }}" name="category_selected[]" value="{{ $category->id }}" {{ (!empty(request()->category_selected) and in_array($category->id, request()->category_selected)) ? 'checked' : '' }}>
            {{ $category->{ get_lang('name') } }}
            <span class="float-right">({{ $category->products_count }})</span>
          </label>
        @endforeach
        <hr>
        
        <h5 class="mt-3">{{ __('messages.grade') }}</h5>
        @foreach ($grades as $grade)
          <label for="m_grade_checkbox{{ $grade->id }}" class="d-block">
            <input type="checkbox" id="m_grade_checkbox{{ $grade->id }}" name="grade_selected[]" value="{{ $grade->id }}" {{ (!empty(request()->grade_selected) and in_array($grade->id, request()->grade_selected)) ? 'checked' : '' }}>
            {{ $grade->{ get_lang('name') } }}
            <span class="float-right">({{ $grade->products_count }})</span>
          </label>
        @endforeach
        <hr>
        
        <h5 class="mt-3">{{ __('messages.price') }}</h5>
        <div class="slider-price">
            <input type="text" id="s21" name="min_price" value="{{ $min_price_selected }}">
            <input type="text" id="s22" name="max_price" value="{{ $max_price_selected }}">
        </div>
        <div id="slider-container2" class="sliderContainer"></div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary w-50" data-dismiss="modal">{{ __('messages.close') }}</button>
          <button type="submit" class="btn w-50">{{ __('messages.search') }}</button>
          <input type="hidden" name="sort" id="sort_mb" value="{{ empty(request()->sort) ?? '1' }}">
        </div>
      </form>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
@endsection

@push('after-scripts')
  <script src="https://d3js.org/d3.v5.min.js"></script>
  <script src="{{ asset('plugins/rangeslider/d3RangeSlider.js') }}"></script>
  <script>
    $(document).ready(function() {
      $("#sort_product").change(function() {
        $('#sort').val($('#sort_product').val());
      });
    });

    $(document).ready(function() {
      $("#sort_product_mb").change(function() {
        $('#sort_mb').val($('#sort_product_mb').val());
      });
    });

    // ช่วงราคาเริ่มต้น default
    var s1 = {{ $min_price }};
    var s2 = {{ $max_price }};
    
    var mi = 0;
    var ma = {{ $max_price }};
    
    var slider = createD3RangeSlider(mi, ma, "#slider-container");
    slider.onChange(function(newRange){
      $("#s1").val(newRange.begin);
      $("#s2").val(newRange.end);
    });
    slider.range(s1,s2);
    $("#s1").val(s1);
    $("#s2").val(s2);
    
    // Range mobile
    var slider2 = createD3RangeSlider(mi, ma, "#slider-container2");
    slider2.onChange(function(newRange2){
      $("#s21").val(newRange2.begin);
      $("#s22").val(newRange2.end);
      $('#menuModal').attr('onclick','RangeSlider('+newRange2.begin+','+newRange2.end+');');
    });
    $("#s21").val(s1);
    $("#s22").val(s2);
    $('#menuModal').attr('onclick','RangeSlider('+s1+','+s2+');');
    
    function RangeSlider(i1,i2) {
      setTimeout(function(){ slider2.range(i1,i2); }, 500);
    }
  </script>
@endpush
