@extends('frontend.layouts.main')
@push('after-css')
{{-- <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" /> --}}
{{-- <link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" /> --}}
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
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.home', ['locale' => get_lang()]) }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.favorite') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="box-products mt-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-sm-7">
                    <h5 class="my-1">{{ __('messages.favorite') }}</h5>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-5">
                    <div class="dropdown show float-right w-100">
                        <div class="col-auto my-1">
                            <label class="mr-sm-2 sr-only" for="sort">Preference</label>
                            <form id="form_search_product" class="form-Search"
                                action="{{ route('frontend.user.favorite', ['locale' => get_lang()]) }}" method="post">
                                @method('get')
                                @csrf
                                <select class="custom-select mr-sm-2" id="sort" name="sort">
                                    {{-- <option value="1" {{ request()->sort == '1' ? 'selected' : '' }}>{{ __('messages.sort_by_recommended') }}
                                    </option> --}}
                                    <option value="2" {{ request()->sort == '2' ? 'selected' : '' }}>
                                        {{ __('messages.sort_by_new') }}</option>
                                    <option value="3" {{ request()->sort == '3' ? 'selected' : '' }}>
                                        {{ __('messages.sort_by_grade_high') }}</option>
                                    <option value="4" {{ request()->sort == '4' ? 'selected' : '' }}>
                                        {{ __('messages.sort_by_grade_low') }}</option>
                                    <option value="5" {{ request()->sort == '5' ? 'selected' : '' }}>
                                        {{ __('messages.sort_by_price_low') }}</option>
                                    <option value="6" {{ request()->sort == '6' ? 'selected' : '' }}>
                                        {{ __('messages.sort_by_price_high') }}</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row box-List py-3">
                @foreach ($favorites as $favorite)
                <div class="col-xl-2 col-lg-3 col-sm-4 col-6 list">
                    <div class="btn-heart active" data-fav="1" data-product="{{ $favorite->products_id }}"></div>
                    <div class="card h-100">
                        <div class="card-body">
                            <a
                                href="{{ route('frontend.product-detail', ['locale' => get_lang(), 'product' => $favorite->products_id]) }}">
                                <div class="img">
                                    <div class="src-img"
                                        style="background-image: url({{ $favorite->products->image ?? 'http://via.placeholder.com/500x350' }})">
                                        <img src="{{ asset('images/size-img.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                                    </div>
                                </div>
                                <div class="box-text">
                                    <h6>{{ $favorite->products->{ get_lang('name') } }}</h6>
                                    <span>{{ __('messages.grade') }} -
                                        {{ $favorite->products->grades_name->{ get_lang('name') } }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="card-footer">
                            <span class="price">{{ __('messages.price') }} :
                                ฿{{ number_format($favorite->products->product_price) }}<b>฿{{ number_format($favorite->products->full_price) }}</b></span>
                            <button type="button" class="btn btn-cart w-100"
                                {{ (empty(Auth::user()) or GlobalFn::productReservedOnCart($favorite->products->id) or GlobalFn::productOutOfStock($favorite->products->id)) ? 'disabled' : '' }}
                                data-product="{{ $favorite->products->id }}">{{ GlobalFn::productOutOfStock($favorite->products->id) ? __('messages.sold_out') : (GlobalFn::productReservedOnCart($favorite->products->id) ? __('messages.out_of_stock') : __('messages.add_basket')) }}</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="box-navigation pb-4">
        <div class="container">
            {{ $favorites->links('frontend.layouts.paginator') }}
        </div>
    </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
      $("#sort").change(function() {
        console.log('xxx');
        $('#form_search_product').submit();
      });
    });
</script>
@endpush
