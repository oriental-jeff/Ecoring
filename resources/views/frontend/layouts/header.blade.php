<div class="navbar navbarTop">
  <div class="container">
    {{ __('messages.project_sponsored_by') }}
    <div class="box-support mr-auto">
      <img src="{{ asset('images/support-1.jpg') }}">
      <img src="{{ asset('images/support-2.jpg') }}">
      <img src="{{ asset('images/support-3.jpg') }}">
      <img src="{{ asset('images/support-4.jpg') }}">
      <img src="{{ asset('images/support-5.jpg') }}">
      <img src="{{ asset('images/support-6.jpg') }}">
      <img src="{{ asset('images/support-7.jpg') }}">
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-xl navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('frontend.home', ['locale' => get_lang()]) }}">
      <img src="{{ asset('images/logo.png') }}" class="I-logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto box-menu">
        @foreach($main['menus'] as $key => $menu)
          @if ($menu->pages->id == $pages->parent_id)
            @php $parent_menu_active = 'dropdown active';
            @endphp
          @else
            @php $parent_menu_active = 'dropdown';
            @endphp
          @endif
          @if ($menu->page_id == $pages->id)
            @php $menu_active = 'active';
            @endphp
          @else
            @php $menu_active = '';
            @endphp
          @endif
          <li id="{{ $menu->id }}" class="nav-item {{ collect($menu->childrens)->count() > 0 ? $parent_menu_active : $menu_active }}">
            <a href="{{ collect($menu->childrens)->count() > 0 ? '#' : route($menu->pages->route_name, ['locale' => get_lang()]) }}" class="nav-link {{ collect($menu->childrens)->count() > 0 ? 'dropdown-toggle' : '' }}"  data-toggle="{{ collect($menu->childrens)->count() > 0 ? 'dropdown' : '' }}">{{ $menu->{ get_lang('name')} }}</a>
            @if(collect($menu->childrens)->count() > 0)
              <div class="dropdown-menu">
                @foreach ($menu->childrens as $key => $child)
                  <a href="{{ collect($child->childrens)->count() > 0 ? '#' : route($child->pages->route_name, ['locale' => get_lang()]) }}" id="{{ $child->id }}" class="dropdown-item {{ $child->page_id == $pages->id ? 'active' : '' }}">{{ $child->{ get_lang('name') } }}</a>
                  </a>
                @endforeach
              </div>
            @endif
          </li>
        @endforeach
        <li class="nav-item">
          <a class="nav-link btn2" href="{{ route('frontend.register', ['locale' => get_lang()]) }}">{{ __('messages.btn_register') }}</a>
        </li>
      </ul>
      <div class="box-social-lang">
        <ul class="navbar-nav menu-social">
          <li>{{ __('messages.btn_follow_us') }}</li>
          @foreach($main['web_socials'] as $web_social)
            @if(!empty($web_social->url))
              <li>
                <a href="{{ $web_social->url }}" target="_blank" rel="noopener">
                  <img src="{{ $web_social->image }}">
                </a>
              </li>
            @endif
          @endforeach
        </ul>
        <div class="dropdown box-lang">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (strtoupper(get_lang()) == 'TH')
              Thai
            @elseif (strtoupper(get_lang()) == 'EN')
              English
            @endif
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @php
              $lang = array('/th/', '/en/');
            @endphp
            <a href="{{ str_replace($lang, '/th/', request()->url()) }}">Thai</a>
            <a href="{{ str_replace($lang, '/en/', request()->url()) }}">English</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
