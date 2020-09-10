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
              <span>My Personal</span>
            </a>
            <ul class="sub-menu">
              <li class="{{ request()->routeIs('backend.profile*') ? 'active' : '' }}">
                <a href="{{ route('backend.profile.index') }}" class="menu-link">Profile</a>
              </li>
            </ul>
          </li>

					@canany (['access role', 'access user'])
						<li class="has-sub {{ request()->routeIs('backend.role*', 'backend.user*')  ? 'active' : '' }}">
							<a href="javascript:;">
					      <b class="caret"></b>
						    <i class="fas fa-cogs"></i>
						    <span>Settings</span>
							</a>
							<ul class="sub-menu">
                @can('access role')
                  <li class="{{ request()->routeIs('backend.role*') ? 'active' : '' }}">
                    <a href="{{ route('backend.role.index') }}" class="menu-link">Role</a>
                  </li>
                @endcan

                @can('access user')
                  <li class="{{ request()->routeIs('backend.user*') ? 'active' : '' }}">
                    <a href="{{ route('backend.user.index') }}" class="menu-link">User</a>
                  </li>
                @endcan
							</ul>
						</li>
          @endcanany

          @canany (['access websoical', 'access webinfo', 'menu_front', 'access page'])
            <li class="has-sub {{ request()->routeIs('backend.websocial*', 'backend.webinfo*', 'backend.menu*', 'backend.page*')  ? 'active' : '' }}">
              <a href="javascript:;">
                <b class="caret"></b>
                <i class="fas fa-home"></i>
                <span>Main System</span>
              </a>
              <ul class="sub-menu">
                @can('access banner')
                  <li class="{{ request()->routeIs('backend.banner*') ? 'active' : '' }}">
                    <a href="{{ route('backend.banner.index') }}" class="menu-link">Banner</a>
                  </li>
                @endcan

                @can('access webinfo')
                  <li class="{{ request()->routeIs('backend.webinfo*') ? 'active' : '' }}">
                    <a href="{{ route('backend.webinfo.index') }}" class="menu-link">Web Info</a>
                  </li>
                @endcan

                @can('access websocial')
                  <li class="{{ request()->routeIs('backend.websocial*') ? 'active' : '' }}">
                    <a href="{{ route('backend.websocial.index') }}" class="menu-link">Social</a>
                  </li>
                @endcan

                @can('menu_front')
                  <li class="{{ request()->routeIs('backend.menu*') ? 'active' : '' }}">
                    <a href="{{ route('backend.menu.index') }}" class="menu-link">Menu</a>
                  </li>
                @endcan

                @can('access page')
                  <li class="{{ request()->routeIs('backend.page*') ? 'active' : '' }}">
                    <a href="{{ route('backend.page.index') }}" class="menu-link">Page (SEO)</a>
                  </li>
                @endcan
              </ul>
            </li>
          @endcanany

          @can('access about')
            <li class="{{ request()->routeIs('backend.about*') ? 'active' : '' }}">
              <a href="{{ route('backend.about.index') }}" class="menu-link"><i class="fas fa-info"></i> <span>About Us</span></a>
            </li>
          @endcan

          @can('access trash')
  				  <li class="{{ request()->routeIs('backend.trash*') ? 'active' : '' }}">
              <a href="{{ route('backend.trash.index') }}" class="menu-link"><i class="fas fa-trash-alt"></i> <span>Trash</span></a>
            </li>
          @endcan

			    <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
          <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
