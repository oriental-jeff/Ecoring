<!-- <section class="box-tebBottom">
  <div class="container">
    <div class="row">
      <div class="col-4 list">
        <div class="footer-box">
          <img src="../../images/icon-footer/box1.svg">
        </div>
        <h6>ส่งฟรีทั่วไทยเมื่อช้อปครบ 2,500.- ขึ้นไป</h6>
        <p>ไม่ว่าจะสินค้าไซส์ไหน จะหูฟังชิ้นเล็ก หรือ จะตู้เย็นเครื่องใหญ่ เราส่งให้ทุกชิ้น!!!</p>
      </div>
      <div class="col-4 list" style="background-color: #f3f3f3;">
        <div class="footer-box">
          <img src="../../images/icon-footer/box2.svg">
        </div>
        <h6>ของแท้ 100% พร้อมการรับประกัน</h6>
        <p>หากสินค้าของคุณมีปัญหามาจากการผลิตเรายินดีเปลี่ยนสินค้าหรือคืนเงินทันที!</p>
      </div>
      <div class="col-4 list">
        <div class="footer-box">
          <img src="../../images/icon-footer/box3.svg">
        </div>
        <h6>รับประกันการติดตั้ง เป็นระยะเวลา 180 วัน</h6>
        <p>เมื่อซื้อสินค้าที่ร้านหรือช้อปออนไลน์ รับทันทีบริการติดตั้ง ฟรี! ไม่มีค่าใช้จ่าย</p>
      </div>
    </div>
  </div>
</section> -->

<section class="box-footer">
    <div class="container">
        <div class="btn-top"></div>

        <div class="row">
            <div class="col-lg-5 list">
                <div class="head-off-on">
                    <b>{{ __('messages.aboutus') }}</b><br>
                </div>
                <div class="text-off-on">
                    <img src="{{ $main['web_info']->logo_foot }}" class="img-logo mb-3">
                    <p>{{ $main['web_info']->{ get_lang('description') } }}</p>
                    <ul>
                        @foreach($main['web_socials'] as $web_social)
                        @if(!empty($web_social->url))
                        <li>
                            <a href="{{ $web_social->url }}" target="_blank" rel="noopener">
                                <img src="{{ $web_social->image }}">
                                {{ $web_social->name }}
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 list">
                <div class="head-off-on">
                    <b>{{ __('messages.contactus') }}</b><br>
                </div>
                <div class="text-off-on">
                    <h6 class="mt-1">{{ $main['web_info']->{ get_lang('company_name') } }}</h6>
                    <p>{{ $main['web_info']->{ get_lang('company_address') } }}</p>
                    <p>{{ __('messages.work_hours') }} : {{ __('messages.work_hours_detail') }}</p>
                    <br>
                    <ul>
                        <li>
                            <a href="#">
                                <img src="{{ asset('images/icon-footer/icon-phone.svg') }}">
                                {{ $main['web_info']->company_tel }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{ asset('images/icon-footer/icon-fax.svg') }}">
                                {{ $main['web_info']->fax }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{ asset('images/icon-footer/icon-email.svg') }}">
                                {{ $main['web_info']->company_email }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="head-off-on open">
                    <b>{{ __('messages.payment') }} - {{ __('messages.bank') }}</b><br>
                </div>
                <div class="text-off-on">
                    <div class="row box-bank">
                        @foreach ($main['bank_transfer'] as $bt)
                        <div class="col-3">
                            <img src="{{ $bt->image ?? '' }}" class="icon-bank">
                        </div>
                        @endforeach
                    </div>

                    <h6 class="mt-4">{{ __('messages.payment') }} - {{ __('messages.credit_card') }}</h6>
                    <div class="row box-bank">
                        <div class="col-5">
                            <img src="{{ asset('images/icon-footer/visa.jpg') }}" class="icon-bank">
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('images/icon-footer/master.jpg') }}" class="icon-bank">
                        </div>
                    </div>

                    <h6 class="mt-4">{{ __('messages.logistic_channel') }}</h6>
                    <div class="row box-bank">
                        @foreach ($main['logistics'] as $logistic)
                        <div class="col-6">
                            <img src="{{ $logistic->image }}" class="icon-bank">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="footer-Copyright">
    <div class="container">
        <p>{{ $main['web_info']->{ get_lang('copyright') } }}</p>

        <div class="Fright d-none d-sm-block">
            <a href="{{ route('frontend.knowledge', ['locale' => get_lang()]) }}">
                {{ __('messages.q&a') }}
            </a>
        </div>

        <div class="Fright d-none d-sm-block">
            <a href="#" data-toggle="modal" data-target="#privacy_policy">{{ __('messages.privacy_policy') }}</a>
        </div>
    </div>
</div>

@if (!empty(GlobalFn::getCountdown()[0][0]))
@php
$time = GlobalFn::getCountdown()[1] == 'cart' ? GlobalFn::getCountdown()[0][0]->updated_at :
GlobalFn::getCountdown()[0][0]->created_at ;
$minutes = GlobalFn::getCountdown()[1] == 'cart' ? 20 : 1440 ; // 20m or 24h
$end_time = $time->addMinutes($minutes);
@endphp
<div id="button-hourglass"><img src="{{ asset('images/I-hourglass.svg') }}"></div>
<div class="box-hourglass">
    <button type="button" id="btn-close"></button>
    <p class="mb-2">{{ __('messages.you_have_product') }}</p>
    <p>{{ GlobalFn::getCountdown()[1] == 'cart' ? __('messages.wait_for_confirm') : __('messages.wait_for_payment') }}
        <b>{{ GlobalFn::getCountdown()[0]->count() }}</b>
        {{ __('messages.list') }}<br>
        {{ __('messages.time_left') }} <b><span id="TRemaining" data-time="{{ $end_time }}"></span></b></p>
    <p>
        @if (GlobalFn::getCountdown()[1] == 'cart')
        <a class="btn font-weight-light radius-25 w-100 mt-3" style="background-color:#fff00d; color: #000;"
            href="{{ route('frontend.cart', ['locale' => get_lang()]) }}">
            <img class="m-0 mr-2" style="width: 23px;" src="{{ asset('images/I-cart.svg') }}">
            {{ __('messages.cart_title') }}
        </a>
        @else
        <a class="btn font-weight-light radius-25 w-100 mt-3" style="background-color:#fff00d; color: #000;"
            href="{{ route('frontend.user.history', ['locale' => get_lang()]) }}">
            <img class="m-0 mr-2" style="width: 23px; fill: #000" src="{{ asset('images/icon-history.svg') }}">
            {{ __('messages.history') }}
        </a>
        @endif
    </p>
</div>
@endif

<div class="box-menu-fixed d-xl-none">
    <ul class="navbar-nav row">
        <li class="nav-item active col">
            <a class="nav-link" href="{{ route('frontend.home', ['locale' => get_lang()]) }}">
                <img src="{{ asset('images/I-home.svg') }}" class="icon-menu">
                {{ __('messages.home') }}
            </a>
        </li>
        <li class="nav-item col">
            <a class="nav-link" href="{{ route('frontend.product', ['locale' => get_lang()]) }}">
                <img src="{{ asset('images/I-shop.svg') }}" class="icon-menu">
                {{ __('messages.product') }}
            </a>
        </li>
        <li class="nav-item col">
            <a class="nav-link" href="{{ route('frontend.payment', ['locale' => get_lang()]) }}">
                <img src="{{ asset('images/I-shield.svg') }}" class="icon-menu">
                {{ __('messages.payment') }}
            </a>
        </li>
        <li class="nav-item col">
            @guest
            <a class="nav-link" href="{{ route('frontend.auth.login.form', ['locale' => get_lang()]) }}">
                <img src="{{ asset('images/I-login.svg') }}" class="icon-menu">
                {{ __('messages.login') }}
            </a>
            @endguest
            @auth
            <a class="nav-link" href="{{ route('frontend.user.profile', ['locale' => get_lang()]) }}">
                <img src="{{ asset('images/I-login.svg') }}" class="icon-menu"> {{ __('messages.hi') }}
                {{ Auth::user()->first_name }}
            </a>
            @endauth
        </li>
    </ul>
</div>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('messages.noti_not_login') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                <a href="{{ route('frontend.auth.login.form', ['locale' => get_lang()]) }}" type="button"
                    class="btn btn-primary">{{ __('messages.login') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Notification -->
<div class="modal fade" id="notiModal" tabindex="-1" aria-labelledby="notiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notiModalLabel">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notiMsg"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('messages.btn_ok') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Privacy -->
<div class="modal fade" id="privacy_policy" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="privacy_policyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacy_policyLabel">{{ $main['policy'][0]->{ get_lang('title') } }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $main['policy'][0]->{ get_lang('description') } !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Understood</button>
            </div>
        </div>
    </div>
</div>

<a href="https://line.me/ti/p/~idline" target="_blank" id="btn-chat-line"></a>

<!-- Your customer chat facebook code -->
<div class="fb-customerchat" attribution=setup_tool page_id="678747588854354" theme_color="#00b06b"
    logged_in_greeting="ecoring สวัสดีครับ ^_^ มีอะไรให้ช่วยเหลือ สอบถามได้เลยนะครับ"
    logged_out_greeting="ecoring สวัสดีครับ ^_^ มีอะไรให้ช่วยเหลือ สอบถามได้เลยนะครับ">
</div>
<div id="fb-root"></div>
