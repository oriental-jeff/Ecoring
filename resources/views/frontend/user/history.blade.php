@extends('frontend.layouts.main')
@push('after-css')
<link href="{{ asset('css/frontend/history.css?v') . time() }}" rel="stylesheet" />
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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.history') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="box-history mt-2">
        <div class="container">
            <div class="row pb-1">
                <div class="col-xl-9 col-lg-8 col-sm-7">
                    <h4 class="mx-auto mb-4">{{ __('messages.history') }}</h4>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-5">
                    <form class="form-inline form-Search float-right w-100"
                        action="{{ route('frontend.user.history', ['locale' => get_lang()]) }}" method="post">
                        @method('get')
                        @csrf
                        <input class="form-control" name="search_orderid" type="text" placeholder="{{ __('messages.search_orders') }}"
                            aria-label="Search" value="{{ request()->search_orderid }}">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                                class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            @foreach ($orders as $order)
            <div class="List">
                <div class="b-List">
                    <div class="bTop">{{ __('messages.order_code') }} : {{ $order->code }}</div>
                    <div class="btext">
                        <div>{{ __('messages.order_date') }} : <br>{{ $order->created_at->format("d/m/Y H:i:s") }}</div>
                        <div>{{ __('messages.cart_quantity') }} : <br>{{ $order->cart->count() }}</div>
                        <div>{{ __('messages.cart_amount') }} :
                            <br>฿{{ number_format($order->total_amount + $order->delivery_charge + $order->vat, 2) }}
                        </div>
                        <div>{{ __('messages.status') }} :
                            <div class="Checkmark status{{ ($order->status >= 3) ? 4 : $order->status+1 }}">
                                {{ ($order->status >= 3) ? $status[3]->{get_lang('name')} : $order->status_config->{get_lang('name')} }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-btn">
                    <a href="{{ route('frontend.user.history-detail', ['locale' => get_lang(), 'order_id' => $order->id]) }}"
                        class="btn btn-secondary font-weight-light radius-25 mx-1"><img
                            src="{{ asset('images/I-see.svg') }}"> {{ __('messages.more_detail') }}</a>
                    <a href="javascript:void(0);" data-orderid="{{ $order->id }}"
                        class="btn-cancel-order btn btn-danger font-weight-light radius-25 mx-1 {{ $order->status > 0 ? 'disabled' : '' }}"
                        {{ $order->status > 0 ? 'disabled' : '' }}><img src="{{ asset('images/I-close.svg') }}">
                        {{ __('messages.cancel_order') }}</a>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    <section class="box-navigation pb-4">
        <div class="container">
            {{ $orders->links('frontend.layouts.paginator') }}
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {

	});
</script>
@endpush
