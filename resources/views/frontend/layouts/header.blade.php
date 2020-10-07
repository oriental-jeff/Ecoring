<div class="navbar-top d-none d-xl-block">
  <div class="container">
    <span>โทร : 02-118-6096 | 日本語 : 063-203-9807 (9:30-18:30)</span>
    <div class="box-social">
      @foreach($main['web_socials'] as $web_social)
        @if(!empty($web_social->url))
          <a href="{{ $web_social->url }}" target="_blank" rel="noopener">
              <img src="{{ $web_social->image }}">
          </a>
        @endif
      @endforeach
      <a class="align-middle">|</a>
      @php
      $lang = array('/th/', '/en/');
      @endphp
      <a href="{{ str_replace($lang, '/en/', request()->url()) }}" class="I-EN">
        <img src="{{ asset('images/I-EN.png') }}">
      </a>
      <a href="{{ str_replace($lang, '/th/', request()->url()) }}" class="I-TH">
        <img src="{{ asset('images/I-TH.png') }}">
      </a>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-xl">
  <div class="container">
    <div class="row box-menu align-items-center m-0">
      <div class="col-xl-2 col-lg-12 d-flex pl-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('frontend.home', ['locale' => get_lang()]) }}">
          <img src="{{ $main['web_info']->logo_head }}" class="img-logo">
        </a>
        <button class="navbar-toggler" type="button">
          <div class="position-relative d-inline-flex">
            <a href="{{ route('frontend.cart', ['locale' => get_lang()]) }}" id="boxOfProductmobile">
              <img src="{{ asset('images/I-cart.svg') }}" class="icon-cart">
              <i class="cart_item">{{ $main['count_cart_products'] }}</i>
            </a>
          </div>
        </button>
      </div>
        <div class="col-xl-10 d-none d-xl-block p-0">
          <!-- menu PC -->
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="row w-100 m-0">
              <div class="col-12 p-0">
                <div class="row">
                  <div class="col-md-8">
                    <ul class="navbar-nav row">
                      @foreach($main['menus'] as $key => $menu)
                        @if (!empty($pages) and $menu->pages->id == $pages->parent_id)
                          @php $parent_menu_active = 'dropdown active';
                          @endphp
                        @else
                          @php $parent_menu_active = 'dropdown';
                          @endphp
                        @endif
                        @if (!empty($pages) and $menu->page_id == $pages->id)
                          @php $menu_active = 'active';
                          @endphp
                        @else
                          @php $menu_active = '';
                          @endphp
                        @endif
                        <li id="{{ $menu->id }}" class="nav-item {{ collect($menu->childrens)->count() > 0 ? $parent_menu_active : $menu_active }} col">
                          <a href="{{ collect($menu->childrens)->count() > 0 ? '#' : route($menu->pages->route_name, ['locale' => get_lang()]) }}" class="nav-link {{ collect($menu->childrens)->count() > 0 ? 'dropdown-toggle' : '' }}" data-toggle="{{ collect($menu->childrens)->count() > 0 ? 'dropdown' : '' }}">
                            <img src="{{ asset('images/' . $menu->icon) }}" class="icon-menu">{{ $menu->{ get_lang('name')} }}
                          </a>
                          @if(collect($menu->childrens)->count() > 0)
                            <div class="dropdown-menu">
                              @foreach ($menu->childrens as $key => $child)
                                <a href="{{ collect($child->childrens)->count() > 0 ? '#' : route($child->pages->route_name, ['locale' => get_lang()]) }}" id="{{ $child->id }}" class="dropdown-item {{ $child->page_id == $pages->id ? 'active' : '' }}">{{ $child->{ get_lang('name') } }}
                                </a>
                              @endforeach
                            </div>
                          @endif
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="col-md-4 align-self-center bar-login">
                    <div class="row">
                      <div class="col-md-6 border-left">
                        @guest
                          <a href="{{ route('frontend.auth.login.form', ['locale' => get_lang()]) }}">
                            <img src="{{ asset('images/I-login.svg') }}" class="icon-login">{{ __('messages.login') }}
                          </a>
                        @endguest
                        @auth
                          <a class="dropdown-toggle" href="javascript:;" role="button"
                              id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                              <img src="{{ asset('images/I-login.svg') }}" class="icon-login"> {{ __('messages.hi') }}
                              {{ Auth::user()->first_name }}
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('frontend.user.profile', ['locale' => get_lang()]) }}">{{ __('messages.data_profile') }}</a>
                            <a class="dropdown-item" href="{{ route('frontend.user.edit-password', ['locale' => get_lang()]) }}">{{ __('messages.edit_password') }}</a>
                            <a class="dropdown-item" href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('messages.logout') }}</a>
                            <form id="logout-form" action="{{ route('frontend.auth.logout', ['locale' => get_lang()]) }}" method="post" style="display: none;">
                              @csrf
                            </form>
                          </div>
                        @endauth
                      </div>
                      <div class="col-md-3 border-left">
                        <a href="{{ !empty(Auth::user()) ? route('frontend.user.favorite', ['locale' => get_lang()]) : 'javascript:;' }}">
                          <img src="{{ asset('images/I-favorite.svg') }}" class="icon-menu">
                        </a>
                      </div>
                      <div class="col-md-3 border-left">
                        <div class="position-relative d-inline-flex">
                          <a href="{{ route('frontend.cart', ['locale' => get_lang()]) }}" id="boxOfProduct">
                            <img src="{{ asset('images/I-cart.svg') }}" class="icon-menu">
                            <i class="cart_item">{{ $main['count_cart_products'] }}</i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-2 mt-md-0 col-12 pr-0" id="menuCategory">
                <form action="{{ route('frontend.product', ['locale' => get_lang()]) }}" class="form-inline" method="get">
                  @method('get')
                  @csrf
                  <input type="text" class="form-control" name="keyword" placeholder="{{ __('messages.search_products') }}.." aria-label="Search" value="{{ request()->keyword }}">
                  <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="fa fa-search"></i></button>
                </form>
                <div class="menu-category">
                  <div class="owl-carousel">
                    @foreach($main['categories'] as $main_category)
                      <div class="item">
                        <a href="{{ route('frontend.product', ['locale' => get_lang(), 'category_id' => $main_category->id]) }}">{{ $main_category->{ get_lang('name') } }}</a>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- menu PC -->
        </div>
    </div>
  </div>
</nav>

<!--///// menu mobile //////-->
<div class="d-xl-none">
  <nav class="navbar navbar-expand-xl navbar-light">
    <div class="collapse navbar-collapse" id="navbarNav">
      <form class="mt-2 mt-md-0 mb-0 col-12 border-bottom">
        <div class="box-Search form-inline">
          <input class="form-control" type="text" placeholder="{{ __('messages.search') }}.." aria-label="Search">
          <button class="btn btn-outline-success my-2 my-0" type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
      <ul class="navbar-nav px-3 text-center">
        @foreach($main['menus'] as $key => $menu)
          @if (!empty($pages) and $menu->pages->id == $pages->parent_id)
            @php $parent_menu_active = 'dropdown active';
            @endphp
          @else
            @php $parent_menu_active = 'dropdown';
            @endphp
          @endif
          @if (!empty($pages) and $menu->page_id == $pages->id)
            @php $menu_active = 'active';
            @endphp
          @else
            @php $menu_active = '';
            @endphp
          @endif
          <li id="{{ $menu->id }}" class="nav-item {{ collect($menu->childrens)->count() > 0 ? $parent_menu_active : $menu_active }}">
              <a href="{{ collect($menu->childrens)->count() > 0 ? '#' : route($menu->pages->route_name, ['locale' => get_lang()]) }}" class="nav-link {{ collect($menu->childrens)->count() > 0 ? 'dropdown-toggle' : '' }}" data-toggle="{{ collect($menu->childrens)->count() > 0 ? 'dropdown' : '' }}">
                <img src="{{ asset('images/' . $menu->icon) }}" class="icon-menu">{{ $menu->{ get_lang('name')} }}
              </a>
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
      </ul>
      <div class="row text-center border-top p-2 bar-login">
        <div class="col-6 border-left p-2">
          @guest
            <a href="{{ route('frontend.auth.login.form', ['locale' => get_lang()]) }}">
              <img src="{{ asset('images/I-login.svg') }}" class="icon-login">{{ __('messages.login') }}
            </a>
          @endguest
          @auth
            <a href="{{ route('frontend.user.profile', ['locale' => get_lang()]) }}">
              <img src="{{ asset('images/I-login.svg') }}" class="icon-login"> {{ __('messages.hi') }} {{ Auth::user()->first_name }}
            </a>
          @endauth
        </div>
        <div class="col-6 border-left p-2">
          <a href="{{ !empty(Auth::user()) ? route('frontend.user.favorite', ['locale' => get_lang()]) : 'javascript:;' }}">
            <img src="{{ asset('images/I-favorite.svg') }}" class="icon-menu mr-2">Favorites
          </a>
        </div>
      </div>
      <div class="navbar-top-mobile">
        <div class="container">
          <span class="my-3 mx-auto w-100">โทร : 02-118-6096 <span class="Nshow-p">|</span> <br class="show-p"> 日本語 : 063-203-9807 (9:30-18:30)</span>
          <div class="box-social pb-3 w-100">
            @php
              $lang = array('/th/', '/en/');
            @endphp
            <a href="{{ str_replace($lang, '/en/', request()->url()) }}" class="I-EN">
              <img src="{{ asset('images/I-EN.png') }}">
            </a>
            <a href="{{ str_replace($lang, '/th/', request()->url()) }}" class="I-TH">
              <img src="{{ asset('images/I-TH.png') }}">
            </a>
            <a class="align-middle">|</a>
            @foreach($main['web_socials'] as $web_social)
              @if(!empty($web_social->url))
                <a href="{{ $web_social->url }}" target="_blank" rel="noopener">
                  <img src="{{ $web_social->image }}">
                </a>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </nav>
</div>
<!--///// menu mobile //////-->
