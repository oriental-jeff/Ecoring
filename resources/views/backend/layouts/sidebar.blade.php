<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header"></li>
            <li class="has-sub {{ request()->routeIs('backend.profile*') ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-user"></i>
                    <span>ข้อมูลบุคคล</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->routeIs('backend.profile*') ? 'active' : '' }}">
                        <a href="{{ route('backend.profile.index') }}" class="menu-link">โปรไฟล์</a>
                    </li>
                </ul>
            </li>

            @canany (['access role', 'access user'])
            <li class="has-sub {{ request()->routeIs('backend.role*', 'backend.user*')  ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-cogs"></i>
                    <span>ตั้งค่า</span>
                </a>
                <ul class="sub-menu">@can('access role')
                    <li class="{{ request()->routeIs('backend.role*') ? 'active' : '' }}">
                        <a href="{{ route('backend.role.index') }}" class="menu-link">บทบาท</a>
                    </li>@endcan

                    @can('access user')
                    <li class="{{ request()->routeIs('backend.user*') ? 'active' : '' }}">
                        <a href="{{ route('backend.user.index') }}" class="menu-link">ผู้ใช้งาน</a>
                    </li>@endcan
                </ul>
            </li>
            @endcanany

            @canany (['access websoical', 'access webinfo', 'menu_front', 'access page'])
            <li
                class="has-sub {{ request()->routeIs('backend.websocial*', 'backend.webinfo*', 'backend.menu*', 'backend.page*', 'backend.bankaccounts*', 'backend.page*')  ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-home"></i>
                    <span>ระบบหลัก</span>
                </a>
                <ul class="sub-menu">
                    @can('access banner')
                    <li class="{{ request()->routeIs('backend.banner*') ? 'active' : '' }}">
                        <a href="{{ route('backend.banner.index') }}" class="menu-link">แบนเนอร์</a>
                    </li>
                    @endcan

                    @can('access webinfo')
                    <li class="{{ request()->routeIs('backend.webinfo*') ? 'active' : '' }}">
                        <a href="{{ route('backend.webinfo.index') }}" class="menu-link">ข้อมูลเว็บ</a>
                    </li>
                    @endcan

                    @can('access branch')
                    <li class="{{ request()->routeIs('backend.branch*') ? 'active' : '' }}">
                        <a href="{{ route('backend.branch.index') }}" class="menu-link">สาขา</a>
                    </li>
                    @endcan

                    @can('access policy')
                    <li class="{{ request()->routeIs('backend.policy*') ? 'active' : '' }}">
                        <a href="{{ route('backend.policy.index') }}" class="menu-link">นโยบาย</a>
                    </li>
                    @endcan

                    @can('access knowledge')
                    <li class="{{ request()->routeIs('backend.knowledge*') ? 'active' : '' }}">
                        <a href="{{ route('backend.knowledge.index') }}" class="menu-link">คลังความรู้</a>
                    </li>
                    @endcan

                    @can('access websocial')
                    <li class="{{ request()->routeIs('backend.websocial*') ? 'active' : '' }}">
                        <a href="{{ route('backend.websocial.index') }}" class="menu-link">สื่อสังคมออนไลน์</a>
                    </li>
                    @endcan

                    @can('menu_front')
                    <li class="{{ request()->routeIs('backend.menu*') ? 'active' : '' }}">
                        <a href="{{ route('backend.menu.index') }}" class="menu-link">เมนู</a>
                    </li>
                    @endcan

                    @can('access page')
                    <li class="{{ request()->routeIs('backend.page*') ? 'active' : '' }}">
                        <a href="{{ route('backend.page.index') }}" class="menu-link">หน้า (SEO)</a>
                    </li>
                    @endcan

                    @can('access bankaccounts')
                    <li class="{{ request()->routeIs('backend.bankaccounts*') ? 'active' : '' }}">
                        <a href="{{ route('backend.bankaccounts.index') }}" class="menu-link">บัญชีธนาคาร</a>
                    </li>
                    @endcan

                    @can('access logistics')
                    <li class="{{ request()->routeIs('backend.logistics*') ? 'active' : '' }}">
                        <a href="{{ route('backend.logistics.index') }}" class="menu-link">บริษัทขนส่ง</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <!-- @can('access about')
        <li class="{{ request()->routeIs('backend.about*') ? 'active' : '' }}">
          <a href="{{ route('backend.about.index') }}" class="menu-link">
            <i class="fas fa-info"></i>
            <span>เกี่ยวกับเรา</span>
          </a>
        </li>
      @endcan -->

            <li
                class="has-sub {{ request()->routeIs('backend.categories*', 'backend.grades*', 'backend.tags*', 'backend.products*', 'backend.product_prices*', 'backend.stocks*')  ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-cubes"></i>
                    <span>สินค้า</span>
                </a>
                <ul class="sub-menu">
                    @can('access categories')
                    <li class="{{ request()->routeIs('backend.categories*') ? 'active' : '' }}">
                        <a href="{{ route('backend.categories.index') }}" class="menu-link">หมวดหมู่</a>
                    </li>
                    @endcan

                    @can('access grades')
                    <li class="{{ request()->routeIs('backend.grades*') ? 'active' : '' }}">
                        <a href="{{ route('backend.grades.index') }}" class="menu-link">เกรดสินค้า</a>
                    </li>
                    @endcan

                    @can('access tags')
                    <li class="{{ request()->routeIs('backend.tags*') ? 'active' : '' }}">
                        <a href="{{ route('backend.tags.index') }}" class="menu-link">แท็กสินค้า (Tags)</a>
                    </li>
                    @endcan

                    @can('access products')
                    <li class="{{ request()->routeIs('backend.products*') ? 'active' : '' }}">
                        <a href="{{ route('backend.products.index') }}" class="menu-link">สินค้า</a>
                    </li>
                    @endcan

                    @can('access product_prices')
                    <li class="{{ request()->routeIs('backend.product_prices*') ? 'active' : '' }}">
                        <a href="{{ route('backend.product_prices.index') }}" class="menu-link">ราคาสินค้า
                            (ตามช่วงเวลา)</a>
                    </li>
                    @endcan

                    @can('access stocks')
                    <li class="{{ request()->routeIs('backend.stocks*') ? 'active' : '' }}">
                        <a href="{{ route('backend.stocks.index') }}" class="menu-link">คลังสินค้า</a>
                    </li>
                    @endcan
                </ul>
            </li>

            <li
                class="has-sub {{ request()->routeIs('backend.promotions*', 'backend.promotion_details*')  ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-gem"></i>
                    <span>โปรโมชั่น</span>
                </a>
                <ul class="sub-menu">
                    @can('access promotions')
                    <li class="{{ request()->routeIs('backend.promotions*') ? 'active' : '' }}">
                        <a href="{{ route('backend.promotions.index') }}" class="menu-link">โปรโมชั่น</a>
                    </li>
                    @endcan

                    @can('access promotion_details')
                    <li class="{{ request()->routeIs('backend.promotion_details*') ? 'active' : '' }}">
                        <a href="{{ route('backend.promotion_details.index') }}"
                            class="menu-link">รายละเอียดโปรโมชั่น</a>
                    </li>
                    @endcan
                </ul>
            </li>

            @can('access logistic_rates')
            <li class="{{ request()->routeIs('backend.logistic_rates*') ? 'active' : '' }}">
                <a href="{{ route('backend.logistic_rates.index') }}" class="menu-link">
                    <i class="fas fa-coins"></i>
                    <span>ค่าบริการขนส่ง</span>
                </a>
            </li>
            @endcan

            <li class="has-sub {{ request()->routeIs('backend.orders*', 'backend.payment_notifications*', 'backend.transactions*')  ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-sitemap"></i>
                    <span>ข้อมูลนำเข้า</span>
                </a>
                <ul class="sub-menu">
                    @can('access orders')
                    <li class="{{ request()->routeIs('backend.orders*') ? 'active' : '' }}">
                        <a href="{{ route('backend.orders.index') }}" class="menu-link">
                            <i class="fas fa-receipt"></i>
                            <span>รายการสั่งซื้อ</span>
                        </a>
                    </li>
                    @endcan

                    @can('access payment_notifications')
                    <li class="{{ request()->routeIs('backend.payment_notifications*') ? 'active' : '' }}">
                        <a href="{{ route('backend.payment_notifications.index') }}" class="menu-link">
                            <i class="fas fa-envelope"></i>
                            <span>แจ้งชำระเงิน</span>
                        </a>
                    </li>
                    @endcan

                    @can('access transactions')
                    <li class="{{ request()->routeIs('backend.transactions*') ? 'active' : '' }}">
                        <a href="{{ route('backend.transactions.index') }}" class="menu-link">
                            <i class="fas fa-credit-card"></i>
                            <span>ประวัติการชำระผ่านบัตร</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            {{-- Menu Reports --}}
            <li class="has-sub {{ request()->routeIs('backend.reports.orders')  ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-file-invoice"></i>
                    <span>รายงาน</span>
                </a>
                <ul class="sub-menu">
                    @can('access report_orders')
                    <li class="{{ request()->routeIs('backend.reports.orders*') ? 'active' : '' }}">
                        <a href="{{ route('backend.reports.orders') }}" class="menu-link">
                            <i class="fas fa-receipt"></i>
                            <span>รายงานการสั่งซื้อสินค้า</span>
                        </a>
                    </li>
                    @endcan

                    @can('access report_products_stock')
                    <li class="">
                        <a href="{{ route('backend.payment_notifications.index') }}" class="menu-link">
                            <i class="fas fa-envelope"></i>
                            <span>รายงานสต๊อกสินค้า</span>
                        </a>
                    </li>
                    @endcan

                    @can('access report_customers')
                    <li class="">
                        <a href="{{ route('backend.transactions.index') }}" class="menu-link">
                            <i class="fas fa-credit-card"></i>
                            <span>รายงานข้อมูลลูกค้า</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            @can('access trash')
            <li class="{{ request()->routeIs('backend.trash*') ? 'active' : '' }}">
                <a href="{{ route('backend.trash.index') }}" class="menu-link">
                    <i class="fas fa-trash-alt"></i>
                    <span>ถังขยะ</span>
                </a>
            </li>
            @endcan

            <!-- begin sidebar minify button -->
            <li>
                <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
                    <i class="fa fa-angle-double-left"></i>
                </a>
            </li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
