@extends('frontend.layouts.main')

@section('title')
@endsection

<link href="{{ asset('css/frontend/index.css?v') . time() }}" rel="stylesheet" />

@section('content')
<!-- begin #content -->
<div id="content" class="content">
    <section class="box-banner">
        <div class="owl-carousel">
            <div class="item" style="background-color: #e2ddb7;">
                <div class="img-banner banner-portrait"
                    style="background-image: url('{{ url("images/banner-m.jpg") }}')"></div>
                <div class="img-banner" style="background-image: url('{{ url("images/banner.jpg") }}');"></div>
            </div>
            <div class="item" style="background-color: #e2ddb7;">
                <div class="img-banner banner-portrait"
                    style="background-image: url('{{ url("images/banner-m.jpg") }}')"></div>
                <div class="img-banner" style="background-image: url('{{ url("images/banner.jpg") }}');"></div>
            </div>
            <div class="item" style="background-color: #e2ddb7;">
                <div class="img-banner banner-portrait"
                    style="background-image: url('{{ url("images/banner-m.jpg") }}')"></div>
                <div class="img-banner" style="background-image: url('{{ url("images/banner.jpg") }}');"></div>
            </div>
            <div class="item" style="background-color: #e2ddb7;">
                <div class="img-banner banner-portrait"
                    style="background-image: url('{{ url("images/banner-m.jpg") }}')"></div>
                <div class="img-banner" style="background-image: url('{{ url("images/banner.jpg") }}');"></div>
            </div>
        </div>
    </section>

    <section class="box-products mt-4 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <h5 class="my-1">{{ __('messages.new_product') }}</h5>
                </div>
                <div class="col-5">
                    <a href="{{ route('frontend.product', ['locale' => get_lang()]) }}"
                        class="float-right btn2">ดูทั้งหมด <i class='fa fa-angle-right'></i></a>
                </div>
            </div>
            <div class="row box-List py-3">
                @foreach ($new_products as $new_product)
                <div class="col-xl-2 col-lg-3 col-sm-4 col-6 list">
                    <div class="btn-heart {{ $new_product->favorites_count > 0 ? 'active' : '' }}"
                        onclick="alert('click');"></div>
                    <div class="card h-100">
                        <div class="card-body">
                            <a
                                href="{{ route('frontend.product-detail', ['locale' => get_lang(), 'product' => $new_product->id]) }}">
                                <div class="img">
                                    <div class="src-img"
                                        style="background-image: url({{ $new_product->image ?? 'http://via.placeholder.com/500x350' }})">
                                        <img src="{{ asset('images/size-img.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                                    </div>
                                </div>
                                <div class="box-text">
                                    <h6>{{ $new_product->{ get_lang('name') } }}</h6>
                                    <span>{{ __('messages.grade') }} -
                                        {{ $new_product->grades_name->{ get_lang('name') } }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="card-footer">
                            <span class="price">{{ __('messages.price') }} :
                                ฿{{ number_format($new_product->price) }}<b>฿{{ number_format($new_product->full_price) }}</b></span>
                            <button type="button" class="btn w-100">{{ __('messages.add_basket') }}</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="box-slide">
        <div class="owl-carousel">
            <div class="item">
                <div class="img-banner banner-portrait" style="background-image: url('../images/banner2-m.jpg')"></div>
                <div class="img-banner" style="background-image: url('../images/banner2.jpg');"></div>
            </div>
            <div class="item">
                <div class="img-banner banner-portrait" style="background-image: url('../images/banner2-m.jpg')"></div>
                <div class="img-banner" style="background-image: url('../images/banner2.jpg');"></div>
            </div>
            <div class="item">
                <div class="img-banner banner-portrait" style="background-image: url('../images/banner2-m.jpg')"></div>
                <div class="img-banner" style="background-image: url('../images/banner2.jpg');"></div>
            </div>
        </div>
    </section>

    <section class="box-Type">
        <div class="container">
            <h5 class="mb-3">ประเภทสินค้า</h5>
        </div>

        <!-- ก้อน PC -->
        <div class="row-Type d-none d-none d-md-block">
            <div class="container">
                <div class="owl-carousel">
                    @foreach ($categories as $category)
                    <div class="item">
                        <a
                            href="{{ route('frontend.product', ['locale' => get_lang(), 'category_id' => $category->id]) }}">
                            <div class="text">{{ $category->{ get_lang('name') } }}</div>
                            <div class="img">
                                <div class="src-img"
                                    style="background-image: url({{ $category->image ?? 'http://via.placeholder.com/500x350/ec7ba5' }})">
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
                <div class="item">
                    <a href="#">
                        <div class="text">กระเป๋า</div>
                        <div class="img">
                            <div class="src-img"
                                style="background-image: url('http://via.placeholder.com/500x350/ec7ba5')">
                                <img src="../images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="#">
                        <div class="text">นาฬิกา</div>
                        <div class="img">
                            <div class="src-img"
                                style="background-image: url('http://via.placeholder.com/500x350/da7bec')">
                                <img src="../images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="#">
                        <div class="text">เครื่องประดับ</div>
                        <div class="img">
                            <div class="src-img"
                                style="background-image: url('http://via.placeholder.com/500x350/9c7bec')">
                                <img src="../images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="#">
                        <div class="text">เซรามิค</div>
                        <div class="img">
                            <div class="src-img"
                                style="background-image: url('http://via.placeholder.com/500x350/7bc2ec')">
                                <img src="../images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="#">
                        <div class="text">เฟอร์นิเจอร์</div>
                        <div class="img">
                            <div class="src-img"
                                style="background-image: url('http://via.placeholder.com/500x350/c1ec7b')">
                                <img src="../images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="#">
                        <div class="text">รองเท้า</div>
                        <div class="img">
                            <div class="src-img"
                                style="background-image: url('http://via.placeholder.com/500x350/c1ec7b')">
                                <img src="../images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
                            </div>
                        </div>
                    </a>
                </div>
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
            <div class="row box-List">
                @foreach ($recommended_products as $recommended_product)
                <div class="col-xl-2 col-lg-3 col-sm-4 col-6 list">
                    <div class="btn-heart {{ $recommended_product->favorites_count > 0 ? 'active' : '' }}"
                        onclick="alert('click');"></div>
                    <div class="card h-100">
                        <div class="card-body">
                            <a
                                href="{{ route('frontend.product-detail', ['locale' => get_lang(), 'product' => $recommended_product->id]) }}">
                                <div class="img">
                                    <div class="src-img"
                                        style="background-image: url({{ $recommended_product->image ?? 'http://via.placeholder.com/500x350' }})">
                                        <img src="{{ asset('images/size-img.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                                    </div>
                                </div>
                                <div class="box-text">
                                    <h6>{{ $recommended_product->{ get_lang('name') } }}</h6>
                                    <span>{{ __('messages.grade') }} -
                                        {{ $recommended_product->grades_name->{ get_lang('name') } }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="card-footer">
                            <span class="price">{{ __('messages.price') }} :
                                ฿{{ number_format($recommended_product->price) }}<b>฿{{ number_format($recommended_product->full_price) }}</b></span>
                            <button type="button" class="btn w-100">{{ __('messages.add_basket') }}</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <a href="#" class="btn3">Load More <i class="fa fa-angle-down"></i></a>
    </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script src="{{ asset('js/frontend/index.js') }}"></script>
@endpush
