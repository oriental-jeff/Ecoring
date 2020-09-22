{{-- <section class="box-tebBottom">
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
</section> --}}

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
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank1.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank2.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank3.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank4.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank5.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank6.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank7.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/icon-bank8.jpg" class="icon-bank">
            </div>
          </div>
          
          <h6 class="mt-4">{{ __('messages.payment') }} - {{ __('messages.credit_card') }}</h6>
          <div class="row box-bank">
            <div class="col-5">
              <img src="../../images/icon-footer/visa.jpg" class="icon-bank">
            </div>
            <div class="col-3">
              <img src="../../images/icon-footer/master.jpg" class="icon-bank">
            </div>
          </div>

          <h6 class="mt-4">{{ __('messages.logistic_channel') }}</h6>
          <div class="row box-bank">
            <div class="col-6">
              <img src="../../images/icon-footer/ep-EMS.jpg" class="icon-bank">
            </div>
            <div class="col-6">
              <img src="../../images/icon-footer/ep-Kerry.jpg" class="icon-bank">
            </div>
            <div class="col-6">
              <img src="../../images/icon-footer/ep-Flash.jpg" class="icon-bank">
            </div>
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
	  <a href="#" data-toggle="modal" data-target="#staticBackdrop">Privacy Policy</a>
    </div>
  </div>
</div>

<div id="button-hourglass"><img src="../../images/I-hourglass.svg"></div>
<div class="box-hourglass">
  <button type="button" id="btn-close"></button>
  <p class="mb-2">คุณมีรายการสินค้า</p>
  <p>รอชำระเงิน <b>3</b> รายการ<br>
  เหลือเวลาอีก <b><span id="TRemaining" data-time="2020-09-16 18:00:00"></span></b></p>
</div>
<div class="box-menu-fixed d-xl-none">
  <ul class="navbar-nav row">
    <li class="nav-item active col">
      <a class="nav-link" href="../home">
        <img src="../../images/I-home.svg" class="icon-menu">
        Home
      </a>
    </li>
    <li class="nav-item col">
      <a class="nav-link" href="../product">
        <img src="../../images/I-shop.svg" class="icon-menu">
        Products
      </a>
    </li>
    <li class="nav-item col">
      <a class="nav-link" href="../payment">
        <img src="../../images/I-shield.svg" class="icon-menu">
        Payment
      </a>
    </li>
    <li class="nav-item col">
      <a class="nav-link" href="../register/login.php">
        <img src="../../images/I-login.svg" class="icon-menu">
        Sign in
      </a>
    </li>
  </ul>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <div class="modal-body">
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>