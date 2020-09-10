@extends('frontend.layouts.main')

@section('title')
@endsection

<link href="{{ asset('css/frontend/index.css?v') . time() }}" rel="stylesheet" />

@section('content')
	<!-- begin #content -->
	<div id="content" class="content">
    <section class="box-banner">
      @foreach($banners as $banner)
        @if($banner->position == 1)
          @foreach($banner->banners_detail as $banner_detail)
            @switch($banner_detail->type)
              @case('image')
                <img src="{{ asset($banner_detail->slide_banner_mobile) }}" class="img-banner banner-portrait">
                <img src="{{ asset($banner_detail->slide_banner_pc) }}" class="img-banner">
              @break
            @endswitch
          @endforeach
        @endif
      @endforeach
      <div class="b-ScrollDown">
        <a href="#section-content" >
          Scroll Down
          <img src="{{ asset('images/I-Arrow.png') }}">
        </a>
      </div>
    </section>
          
    <section class="box-content" id="section-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="box-text">
              <img src="{{ asset('images/img-logo.png') }}" class="img-logo">
              <p>{{ $main['web_info']->{get_lang('description')} }}</p>
            </div>
            <a class="btn1" href="{{ route('frontend.about', ['locale' => get_lang()]) }}" role="button">{{ __('messages.btn_view_more') }}</a>
          </div>
          <div class="col-lg-5 d-flex align-content-around flex-wrap justify-content-end">
            <div class="box-Rtext">
              Art Exchange: “Imagine” <i class="Underline">Artistic Dialects: Thinking into Doing.</i>
            </div>
            <ul class="box-support d-flex align-content-around flex-wrap justify-content-end">
              <li><img src="{{ asset('images/support-1.jpg') }}"></li>
              <li><img src="{{ asset('images/support-2.jpg') }}"></li>
              <li><img src="{{ asset('images/support-3.jpg') }}"></li>
              <li><img src="{{ asset('images/support-4.jpg') }}"></li>
              <li><img src="{{ asset('images/support-5.jpg') }}"></li>
              <li><img src="{{ asset('images/support-6.jpg') }}"></li>
              <li><img src="{{ asset('images/support-7.jpg') }}"></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
          
    <section class="box-Register">
      <div class="BG-Register">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="box-text">
                <h3>Register &</h3>
                <h1>Submit your <i class="head2">Project</i></h1>
                <p>{{ __('messages.submit_your_project_description') }}</p>
              </div>
            </div>
            <div class="col-lg-4 d-flex align-content-around flex-wrap justify-content-end">
              <a class="btn1" href="{{ route('frontend.register', ['locale' => get_lang()]) }}" role="button">{{ __('messages.btn_register') }}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
          
    @if (date('Y-m-d') >= '2020-09-30')
      <section class="box-Projects">
        <div class="container">
          <div class="row">
            @foreach ($projects as $project)
              @if ($project->application->active == 'Active')
                <div class="col-lg-4 col-sm-6">
                  <a href="{{ route('frontend.project-detail', ['locale' => get_lang(), 'project' => $project->id]) }}">
                    <div class="box-List" data-pro="{{ substr($project->application->occupation, 0, 3) }}" data-star="{{ ($project->recommend == '1') ? 'true' : '' }}">
                      <div class="img">
                        <div class="src-img" style="background-image: url({{ \App\Http\Controllers\Frontend\GalleryController::getCoverPicture('cover', $project->application->occupation, $project) }})">
                          <img src="{{ asset('images/size-img.png') }}" alt=""><!-- ช่องนี้ห้ามแก้ -->
                        </div>
                      </div>
                      <div class="text">
                        <div class="box-name">
                          {{ $project->title }}
                          <div class="view">{{ $views[$project->id] ?? '0'}}</div>
                        </div>
                        <div class="b-Tcolor">
                          <span>{{ ($project->technique == 'Other') ? $project->technique_other : $project->technique }}</span>

                          <div class="box-I">
                            @if ($project->image_motionclipFac1 OR
                                $project->image_motionclipFac2 OR
                                $project->image_motionclipFac3 OR
                                $project->image_motionclipStu1 OR
                                $project->image_motionclipPra1)
                                <i class="I-vdo">vdo</i>
                            @endif
                            @if ($project->image_posterFac1 OR
                                $project->image_posterFac2 OR
                                $project->image_posterFac3 OR
                                $project->image_posterStu1 OR
                                $project->image_posterPra1)
                                <i class="I-img">img</i>
                            @endif
                          </div>
                        </div>
                        <div class="b-profile">
                          <img src="{{ \App\Http\Controllers\Frontend\GalleryController::getCoverPicture('profile', $project->application->occupation, $project) }}">
                          <div class="b-name">
                            {{ $project->application->fullname }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              @endif
            @endforeach
          </div>
          @if(!empty($projects))
            <div class="box-btn">
              <a class="btn1" href="{{ route('frontend.gallery', ['locale' => get_lang()]) }}" role="button">{{ __('messages.btn_view_more') }}</a>
            </div>
          @endif
        </div>
      </section>
    @endif
  </div>
  <!-- end #content -->
@endsection

@push('after-scripts')
  <script src="{{ asset('js/frontend/index.js') }}"></script>
@endpush
