@extends('frontend.layouts.main')

@section('title')
@endsection

<link href="{{ asset('css/frontend/index.css?v') . time() }}" rel="stylesheet" />

@section('content')
	<!-- begin #content -->
	<div id="content" class="content">
    <section class="box-banner">
      <div class="owl-carousel">
        @foreach($banners as $banner)
          @if($banner->position == 1)
            @foreach($banner->banners_detail as $banner_detail)
              @switch($banner_detail->type)
                @case('image')
                  <a href="{{ $banner_detail->url ?? '#' }}" target="_blank">
                    <div class="item" style="background-color: #e2ddb7;">
                      <div class="img-banner banner-portrait" style="background-image: url('{{ $banner_detail->slide_banner_mobile }}')"></div>
                      <div class="img-banner" style="background-image: url('{{ $banner_detail->slide_banner_pc }}')"></div>
                    </div>
                  </a>
                @break
                @case('video')
                  <div class="item" style="background-color: #e2ddb7;">
                    <video src="{{ $banner_detail->banner_video }}" muted autoplay loop></video>
                    <div class="this-none"></div>
                  </div>
                @break
                @case('youtube')
                  <div class="item" style="background-color: #e2ddb7;">
                    <iframe src="https://www.youtube.com/embed/{{$banner_detail->url}}?mute=1&autoplay=1&loop=1&playlist={{$banner_detail->url}}" frameborder="0"></iframe>
                    <a href="https://www.youtube.com/embed/{{$banner_detail->url}}?autoplay=1&loop=1&playlist={{$banner_detail->url}}" target="_blank"><div class="this-none"></div></a>
                  </div>
                @break
              @endswitch
            @endforeach
          @endif
        @endforeach
      </div>
    </section>

    <section class="box-products mt-4 pt-4">
      <div class="container">
        <div class="row">
          <div class="col-7">
            <h5 class="my-1">{{ __('messages.new_product') }}</h5>
          </div>
          <div class="col-5">
            <a href="{{ route('frontend.product', ['locale' => get_lang()]) }}" class="float-right btn2">ดูทั้งหมด <i class='fa fa-angle-right'></i></a>
          </div>
        </div>
        <div class="row box-List py-3">
          @foreach ($new_products as $new_product)
            <div class="card col-xl-2 col-lg-3 col-sm-4 col-6 list">
              <div class="btn-heart {{ $new_product->favorites_count > 0 ? 'active' : '' }}" data-fav="{{ $new_product->favorites_count }}" data-product="{{ $new_product->id }}"></div>
              <div class="card-body">
              	<a href="{{ route('frontend.product-detail', ['locale' => get_lang(), 'product' => $new_product->id]) }}">
                  <div class="img">
                  	<div class="src-img" style="background-image: url({{ $new_product->image ?? 'http://via.placeholder.com/500x350' }})">
                      <img src="{{ asset('images/size-img.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                  	</div>
                  </div>
                  <div class="box-text">
                  	<h6>{{ $new_product->{ get_lang('name') } }}</h6>
                    <span>{{ __('messages.grade') }} - {{ $new_product->grades_name->{ get_lang('name') } }}</span>
                  </div>
            	</a>
              </div>
              <div class="card-footer">
                <span class="price">{{ __('messages.price') }} : ฿{{ number_format($new_product->price) }}<b>฿{{ number_format($new_product->full_price) }}</b></span>
                <button type="button" class="btn btn-cart w-100" {{ empty(Auth::user()) ? 'disabled' : '' }} data-product="{{ $new_product->id }}">{{ __('messages.add_basket') }}</button>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
          
    <section class="box-slide">
      <div class="owl-carousel">
        @foreach($banners as $banner)
          @if($banner->position == 2)
            @foreach($banner->banners_detail as $banner_detail)
              @switch($banner_detail->type)
                @case('image')
                  <div class="item">
                    <div class="img-banner banner-portrait" style="background-image: url('{{ $banner_detail->slide_banner_mobile }}')"></div>
                    <div class="img-banner" style="background-image: url('{{ $banner_detail->slide_banner_pc }}')"></div>
                  </div>
                @break
                @case('video')
                  <div class="item">
                    <video src="{{ $banner_detail->banner_video }}" muted autoplay loop></video>
                    <div class="this-none"></div>
                  </div>
                @break
                @case('youtube')
                  <div class="item">
                    <iframe src="https://www.youtube.com/embed/{{$banner_detail->url}}?mute=1&autoplay=1&loop=1&playlist={{$banner_detail->url}}" frameborder="0"></iframe>
                    <a href="https://www.youtube.com/embed/{{$banner_detail->url}}?autoplay=1&loop=1&playlist={{$banner_detail->url}}" target="_blank"><div class="this-none"></div></a>
                  </div>
                @break
              @endswitch
            @endforeach
          @endif
        @endforeach
      </div>
    </section>
          
    <section class="box-Type">
      <div class="container">
        <h5 class="mb-3">{{ __('messages.category') }}</h5>
      </div>
        
      <!-- ก้อน PC -->
      <div class="row-Type d-none d-none d-md-block">
        <div class="container">
          <div class="owl-carousel">
            @foreach ($categories as $category)
              <div class="item">
                <a href="{{ route('frontend.product', ['locale' => get_lang(), 'category_id' => $category->id]) }}">
                  <div class="text">{{ $category->{ get_lang('name') } }}</div>
                  <div class="img">
                    <div class="src-img" style="background-image: url({{ $category->image ?? 'http://via.placeholder.com/500x350/ec7ba5' }})">
                      <img src="{{ asset('images/size-img2.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
        <div class="o-prev"><img src="{{ asset('images/icon-arrow.png') }}"></div>
        <div class="o-next"><img src="{{ asset('images/icon-arrow.png') }}"></div>
      </div>
      <!-- ก้อน PC -->
        
      <!-- ก้อน mobile -->
      <div class="row-Type row-Type-mobile d-md-none">
        <div class="container">
	        @foreach ($categories as $category)
	          <div class="item">
	            <a href="{{ route('frontend.product', ['locale' => get_lang(), 'category_id' => $category->id]) }}">
	              <div class="text">{{ $category->{ get_lang('name') } }}</div>
	              <div class="img">
	                <div class="src-img" style="background-image: url({{ $category->image ?? 'http://via.placeholder.com/500x350/ec7ba5' }})">
	                  <img src="{{ asset('images/size-img2.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
	                </div>
	              </div>
	            </a>
	          </div>
	        @endforeach
        </div>
      </div>
      <!-- ก้อน mobile -->
    </section>

    <section class="box-products">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h5>{{ __('messages.recommended_product') }}</h5>
          </div>
        </div>
        <div class="row box-List lazyload">
          @foreach ($recommended_products as $recommended_product)
          <div class="card col-xl-2 col-lg-3 col-sm-4 col-6 list">
            <div class="btn-heart {{ $recommended_product->favorites_count > 0 ? 'active' : '' }}" data-fav="{{ $recommended_product->favorites_count }}" data-product="{{ $recommended_product->id }}"></div>
            <div class="card-body">
              <a href="{{ route('frontend.product-detail', ['locale' => get_lang(), 'product' => $recommended_product->id]) }}">
                <div class="img">
                  <div class="src-img" style="background-image: url({{ $recommended_product->image ?? 'http://via.placeholder.com/500x350' }})">
                    <img src="{{ asset('images/size-img.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                  </div>
                </div>
                <div class="box-text">
                  <h6>{{ $recommended_product->{ get_lang('name') } }}</h6>
                  <span>{{ __('messages.grade') }} - {{ $recommended_product->grades_name->{ get_lang('name') } }}</span>
                </div>
              </a>
            </div>
            <div class="card-footer">
              <span class="price">{{ __('messages.price') }} : ฿{{ number_format($recommended_product->price) }}<b>฿{{ number_format($recommended_product->full_price) }}</b></span>
              <button type="button" class="btn btn-cart w-100" {{ empty(Auth::user()) ? 'disabled' : '' }} data-product="{{ $recommended_product->id }}">{{ __('messages.add_basket') }}</button>
            </div>
          </div>
          @endforeach
        </div>
      </div>
	  <a href="#" class="btn3" id="a-lazyload">Load More <i class="fa fa-angle-down"></i></a>
    </section>
  </div>
  <!-- end #content -->
@endsection

@push('after-scripts')
  <script src="{{ asset('js/frontend/index.js') }}"></script>
@endpush
