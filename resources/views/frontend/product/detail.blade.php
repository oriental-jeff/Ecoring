@extends('frontend.layouts.main')
@push('after-css')
  <link href="{{ asset('css/frontend/detail.css?v') . time() }}" rel="stylesheet" />
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
            <li class="breadcrumb-item"><a href="{{ route('frontend.product', ['locale' => get_lang()]) }}">{{ $pages->{ get_lang('title') } }}</a></li>
				    <li class="breadcrumb-item active" aria-current="page">{{ $product->{ get_lang('name') } }}</li>
				  </ol>
				</nav>
			</div>
    </section>
	        
    <section class="box-products mt-2">
			<div class="container">
				<div class="row" id="Boxheight">
					<div class="col-lg-9">
						<div class="row">
							<div class="col-md-6 box-showImg">
								<div class="img d-none d-md-block">
									<div class="src-img" style="background-image: url({{ $product->image ?? 'http://via.placeholder.com/500x350' }})"  id="showImg2">
                    <img src="{{ asset('images/size-img2.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                  </div>
                  @if(!empty($product->image_detail))
                    @php
                    $i = 0;
                    @endphp
                    @foreach($product->image_detail as $img)
                      @php
                      $i++;
                      @endphp
                      <a href="{{ $img->getUrl() ?? 'http://via.placeholder.com/500x350' }}" data-fancybox="images" data-id="{{ $i }}" class="{{ $i == 1 ? 'active' : '' }}"></a>
                    @endforeach
                  @endif
                </div>
                <div class="owl-carousel">
                  @if(!empty($product->image_detail))
                    @php
                    $i = 0;
                    @endphp
                    @foreach($product->image_detail as $img)
                      @php
                      $i++;
                      @endphp
                      <div class="item img">
                        <a href="javascript:;" onclick="showImg({{ $i }}, '{{ $img->getUrl() }}');">
                          <div class="src-img" style="background-image: url({{ $img->getUrl() ?? 'http://via.placeholder.com/500x350' }})">
                            <img src="{{ asset('images/size-img2.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                          </div>
                        </a>
                      </div>
                    @endforeach
                  @endif
                </div>
							</div>
							<div class="col-md-6">
								<h4 class="text-head">
									<!-- favorites mobile -->
									<div class="icon-Favorites float-right ml-2 d-block d-lg-none {{ $product->favorites_count > 0 ? 'active' : '' }}" onclick="alert('click');">{{ __('messages.favorite') }}</div>
									<!-- favorites mobile -->
									{{ $product->{ get_lang('name') } }}
								</h4>
								<hr>
								<div class="box-Toggle" id="b-Toggle">
								  <div class="b-Toggle">
									{!! $product->{ get_lang('description') } !!}
								  </div>
								</div>
								<button type="button" id="button-Toggle1" class="p-2 mt-2 border-0 w-100" onclick="$('#b-Toggle').toggleClass('open');$(this).hide();$('#button-Toggle2').show();">
									{{ __('messages.show_more') }} <img src="{{ asset('images/icon-select.png') }}">
								</button>
								<button type="button" id="button-Toggle2" class="p-2 mt-2 border-0 w-100" style="display: none" onclick="$('#b-Toggle').toggleClass('open');$(this).hide();$('#button-Toggle1').show();">
									{{ __('messages.show_less') }} <img id="button-Toggle2" src="{{ asset('images/icon-select.png') }}" style="transform: rotate(180deg);">
								</button>

							</div>
						</div>
						<hr>
					</div>
					<div class="col-lg-3 box-left-sticky">
						<div class="b-sticky">
							<!-- favorites PC -->
							<div class="icon-Favorites d-none d-lg-block {{ $product->favorites_count > 0 ? 'active' : '' }}" onclick="alert('click');">{{ __('messages.favorite') }}</div>
							<!-- favorites PC -->
						
							<hr class="d-none d-lg-block">
							<div class="font-weight-bold mt-3 clearfix">{{ __('messages.grade') }} <h3 class="float-right">{{ $product->grades_name->{ get_lang('name') } }}</h3></div>
							<div class="font-weight-bold mt-3 clearfix"><b class="line-through">฿{{ number_format($product->full_price) }}</b> <h4 class="float-right">{{ __('messages.price') }} : ฿{{ number_format($product->price) }}</h4></div>
							<div class="font-weight-bold mt-3 clearfix">
								{{ __('messages.quantity') }}
								<div class="btn-group">
							    <button type="button" class="btn btn-delete disabled">-</button>
							    <input type="text" class="btn" value="1">
							    <button type="button" class="btn btn-plus">+</button>
								</div>
							</div>
							<br>
							<div class="mt-3" style="color: #00b16b;">{{ __('messages.product_total_quantity') }} : {{ $product->stocks[0]->quantity }} {{ __('messages.unit') }}</div>
							<br>
							<button type="button" class="btn border-0 w-100" {{ empty(Auth::user()) ? 'disabled' : '' }}>{{ __('messages.add_basket') }}</button>
							<br>
							{{-- <div class="mt-3" style="color: #00b16b;">ราคานี้ตั้งแต่ 16/03/2020 ถึง 16/03/2020 ราคานี้ใช้สำหรับการสั่งซื้อทางออนไลน์เท่านั้น</div>
							<br> --}}
							
							{{-- <div class="box-icon-list">
								<div class="footer-box">
									<img src="../../images/icon-footer/box1.svg">
								</div>
								<b>ส่งฟรีทั่วไทยเมื่อช้อปครบ 2,500.- ขึ้นไป</b>
							</div>
							<div class="box-icon-list">
								<div class="footer-box">
									<img src="../../images/icon-footer/box2.svg">
								</div>
								<b>ของแท้ 100% พร้อมการรับประกัน</b>
							</div>
							<div class="box-icon-list">
								<div class="footer-box">
									<img src="../../images/icon-footer/box3.svg">
								</div>
								<b>รับประกันการติดตั้ง เป็นระยะเวลา 180 วัน</b>
							</div> --}}
							
							<hr>
							<!-- social PC -->
							<div class="my-3 d-none d-xl-block" style="color: #00b16b;">{{ __('messages.share') }} :
								<div class="box-social d-inline-block">
					        <a class="I-fb" href="{{ get_link_share_facebook() }}" target="_blank" rel="noopener" aria-label="facebook"><img src="{{ asset('images/icon-social-fb.png') }}"></a>
                  <a class="I-tw" href="{{ get_link_share_twitter( $product->{ get_lang('title') } ) }}" target="_blank" rel="noopener" aria-label="twitter"><img src="{{ asset('images/icon-social-tw.png') }}"></a>
							   </div>
							</div>
							<!-- social PC -->
						</div>
					</div>
					<div class="col-lg-9">
						<div class="box-Toggle" id="b-Toggle2">
						  <div class="b-Toggle">
							{!! $product->{ get_lang('info') } !!}
						  </div>
						</div>
						<button type="button" id="button-Toggle3" class="p-2 mt-2 border-0 w-100" onclick="$('#b-Toggle2').toggleClass('open');$(this).hide();$('#button-Toggle4').show();">
							{{ __('messages.show_more') }} <img src="{{ asset('images/icon-select.png') }}">
						</button>
						<button type="button" id="button-Toggle4" class="p-2 mt-2 border-0 w-100" style="display: none" onclick="$('#b-Toggle2').toggleClass('open');$(this).hide();$('#button-Toggle3').show();">
							{{ __('messages.show_less') }} <img id="button-Toggle2" src="{{ asset('images/icon-select.png') }}" style="transform: rotate(180deg);">
						</button>
						<hr class="mt-4">
						<div class="tag">
							<h5>{{ __('messages.tags') }} :</h5>
              @foreach ($product->producttags as $product_tag)
                <a href="#">{{ $product_tag->tags->{ get_lang('name') } }}</a>
              @endforeach
						</div>
						
						<!-- social mobile -->
						<div class="d-block d-xl-none" style="color: #00b16b;">{{ __('messages.share') }} :
							<div class="box-social d-inline-block">
				        <a class="I-fb" href="{{ get_link_share_facebook() }}" target="_blank" rel="noopener" aria-label="facebook"><img src="{{ asset('images/icon-social-fb.png') }}"></a>
                <a class="I-tw" href="{{ get_link_share_twitter( $product->{ get_lang('title') } ) }}" target="_blank" rel="noopener" aria-label="twitter"><img src="{{ asset('images/icon-social-tw.png') }}"></a>
					    </div>
						</div>
						<!-- social mobile -->

					</div>
				</div>
			</div>
    </section>
	        
    <section class="box-relate box-products mt-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="arrow-default">
							<div class="o-prev"><img src="{{ asset('images/icon-arrow.png') }}"></div>
							<div class="o-next"><img src="{{ asset('images/icon-arrow.png') }}"></div>
						</div>
						<h5 class="my-1">{{ __('messages.new_product') }}</h5>
					</div>
				</div>

        <div class="owl-carousel box-List">
          @foreach ($new_products as $new_product)
			<div class="card item col-12 list">
				<div class="btn-heart {{ $new_product->favorites_count > 0 ? 'active' : '' }}" onclick="alert('click');"></div>
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
					<button type="button" class="btn w-100" {{ empty(Auth::user()) ? 'disabled' : '' }}>{{ __('messages.add_basket') }}</button>
				</div>
			</div>
          @endforeach
        </div>
			</div>
    </section>
	</div>
  <!-- end #content -->
@endsection

@push('after-scripts')
  <script src="{{ asset('js/frontend/detail.js') }}"></script>
  <script>
    function showImg(id,src) {
      $('.box-showImg > .img > a[data-id='+id+']').addClass('active');
      $('.box-showImg > .img > a:not([data-id='+id+'])').removeClass('active');
      $('#showImg2').css('background-image','url('+src+')');
    }
  </script>
@endpush
