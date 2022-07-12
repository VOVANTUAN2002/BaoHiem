    <!-- .app-aside -->
    <aside class="app-aside app-aside-expand-md app-aside-light">
      <!-- .aside-content -->
      <div class="aside-content">
        <!-- .aside-header -->
        <header class="aside-header d-block d-md-none">
          <!-- .btn-account -->
          <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span class="user-avatar user-avatar-lg"><img src="assets/images/avatars/profile.jpg" alt=""></span> <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span> <span class="account-summary"><span class="account-name">Beni Arisandi</span> <span class="account-description">Marketing Manager</span></span></button> <!-- /.btn-account -->
          <!-- .dropdown-aside -->
          <div id="dropdown-aside" class="dropdown-aside collapse">
            <!-- dropdown-items -->
            <div class="pb-3">
              <a class="dropdown-item" href="user-profile.html"><span class="dropdown-icon oi oi-person"></span> Profile</a> <a class="dropdown-item" href="auth-signin-v1.html"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Help Center</a> <a class="dropdown-item" href="#">Ask Forum</a> <a class="dropdown-item" href="#">Keyboard Shortcuts</a>
            </div><!-- /dropdown-items -->
          </div><!-- /.dropdown-aside -->
        </header><!-- /.aside-header -->
        <!-- .aside-menu -->
        <div class="aside-menu overflow-hidden">
          <!-- .stacked-menu -->
          <nav id="stacked-menu" class="stacked-menu">
            <!-- .menu -->
            <ul class="menu">
              <!-- .menu-item -->
              <li class="menu-item">
                <a href="{{route('admin.index')}}" class="menu-link">
                  <span class="menu-icon fas fa-home"></span>
                  <span class="menu-text">Trang Chủ</span>
                </a>
              </li><!-- /.menu-item -->
              <li class="menu-header">Bán Hàng </li>

              @if(Auth::user()->hasPermission('Product_viewAny'))
              <li class="menu-item">
                <a href="{{ route('products.index') }}" class="menu-link">
                  <span class="menu-icon oi oi-list-rich"></span>
                  <span class="menu-text">Sản Phẩm</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->hasPermission('ProductCategory_viewAny'))
              <li class="menu-item">
                <a href="{{ route('productCategories.index') }}" class="menu-link">
                  <span class="menu-icon oi oi-puzzle-piece"></span>
                  <span class="menu-text">Loại Sản Phẩm</span>
                </a>
              </li>
              @endif

              <li class="menu-header">Nguồn Lực</li>

              @if(Auth::user()->hasPermission('User_viewAny'))
              <li class="menu-item has-child">
                <a href="{{ route('users.index') }}" class="menu-link">
                  <span class="menu-icon oi oi-person"></span>
                  <span class="menu-text">Nhân Viên</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->hasPermission('UserGroup_viewAny'))
              <li class="menu-item">
                <a href="{{ route('userGroups.index') }}" class="menu-link">
                  <span class="menu-icon oi oi-people"></span>
                  <span class="menu-text">Nhóm Nhân Viên</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->hasPermission('Branch_viewAny'))
              <li class="menu-item">
                <a href="{{ route('branches.index') }}" class="menu-link">
                  <span class="menu-icon fas fa-rocket"></span>
                  <span class="menu-text">Chi Nhánh</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->hasPermission('Customer_viewAny'))
              <li class="menu-item">
                <a href="{{ route('customers.index') }}" class="menu-link">
                  <span class="menu-icon oi oi-aperture"></span>
                  <span class="menu-text">Khách Hàng</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->hasPermission('Message_viewAny'))
              <li class="menu-item">
                <a href="{{ route('messages.index') }}" class="menu-link">
                  <span class="menu-icon fas fa-comment-alt"></span>
                  <span class="menu-text">Tin Nhắn</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->hasPermission('Paper_viewAny'))
              <li class="menu-item">
                <a href="{{ route('papers.index') }}" class="menu-link">
                  <span class="menu-icon fas fa-paste"></span>
                  <span class="menu-text">Giấy Tờ</span>
                </a>
              </li>
              @endif
              <li class="menu-header">Hệ Thống</li>

              @if(Auth::user()->hasPermission('Config_viewAny'))
              <li class="menu-item">
                <a href="{{ route('configs.index') }}" class="menu-link">
                  <span class="menu-icon fa fa-cog"></span>
                  <span class="menu-text">Cấu Hình</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->hasPermission('Systemlog_viewAny'))
              <li class="menu-item">
                <a href="{{ route('systemlogs.index') }}" class="menu-link">
                  <span class="menu-icon fa fa-book"></span>
                  <span class="menu-text">Nhật Ký Hoạt Động</span>
                </a>
              </li>
              @endif



              <!-- .menu-item -->

            </ul><!-- /.menu -->
          </nav><!-- /.stacked-menu -->
        </div><!-- /.aside-menu -->
        <!-- Skin changer -->
        <footer class="aside-footer border-top p-2">
          <button class="btn btn-light btn-block text-primary" data-toggle="skin"><span class="d-compact-menu-none">Night mode</span> <i class="fas fa-moon ml-1"></i></button>
        </footer><!-- /Skin changer -->
      </div><!-- /.aside-content -->
    </aside><!-- /.app-aside -->
