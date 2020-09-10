@extends('frontend.layouts.main')

@section('title')
@endsection

<link href="{{ asset('css/frontend/about.css?v') . time() }}" rel="stylesheet" />

@section('content')
  <!-- begin #content -->
  <div id="content" class="content">
    <section class="box-top">
			<div class="container">
				<div class="box-support">
          <img src="{{ asset('images/support-1.jpg') }}">
          <img src="{{ asset('images/support-2.jpg') }}">
          <img src="{{ asset('images/support-3.jpg') }}">
          <img src="{{ asset('images/img-logo.png') }}" class="img-logo">
          <img src="{{ asset('images/support-4.jpg') }}">
          <img src="{{ asset('images/support-5.jpg') }}">
          <img src="{{ asset('images/support-6.jpg') }}">
          <img src="{{ asset('images/support-7.jpg') }}">
				</div>
				<img src="{{ asset('images/text-about.jpg') }}" class="img-text-about">
		    <br>
		    <img src="{{ asset('images/box-color01.png') }}" class="mx-auto d-table">
		    <br>
			</div>
    </section>
    
    <section class="box-detail">
      <div class="container">
        <div class="box-line">
          <div class="box-line2">
            <h6 class="pt-2">{{ __('messages.project_name') }}</h6>
            <p>{{ $aboutus->{ get_lang('title') } }}</p>
            
            <h6 class="pt-2">{{ __('messages.project_type') }}</h6>
            <p>{{ $aboutus->{ get_lang('type') } }}</p>
            
            <h6>{{ __('messages.project_description') }}</h6>
            {!! $aboutus->{ get_lang('description1')} !!}
            
            <h3 class="pt-4 pb-2 BG-line3">Art Exchange 2020: “Imagine” Artistic Dialects: <br>Thinking into Doing 5 Sub themes</h3>
            
            {!! $aboutus->{ get_lang('description2')} !!}
            
            <div class="my-5">
              <b>{{ __('messages.project_download') }} :</b> <a href="{{ asset('files/Description_Thai.docx') }}" class="btn2" download>Thai Version</a> <a href="{{ asset('files/Description_Eng.docx') }}" class="btn2" download>English Version</a>
            </div>
            
            <hr>
            
            {!! $aboutus->{ get_lang('description3')} !!}
            <br><br><br>
					</div>
				</div>
			</div>
    </section>
  </div>
	<!-- end #content -->
@endsection

@push('after-scripts')
@endpush
