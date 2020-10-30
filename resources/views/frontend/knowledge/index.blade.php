@extends('frontend.layouts.main')
@section('title')
@endsection

@section('content')
<!-- begin #content -->
<div id="content" class="content">
    <section class="box-breadcrumb d-none d-md-block">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.home', ['locale' => get_lang()]) }}">{{ __('messages.home') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.knowledge') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="mt-2 mb-5">
        <div class="container">
            <h4>{{ (get_lang() == 'th' ? $knowledges->title_th : $knowledges->title_en) }}</h4>
            <div class="row mt-3">
                <div class="col-md-12 text-left">
                    {!! (get_lang() == 'th' ? $knowledges->content_th : $knowledges->content_en) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <button type="button" class="btn btn-block btn-secondary" onclick="back()">
                    {{ __('messages.btn_back') }}
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
    <script>
        function back() {
            window.history.back();
        }
    </script>
@endpush
