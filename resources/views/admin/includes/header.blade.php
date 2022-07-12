<header class="app-header app-header-dark">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">

    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- .top-bar -->
    <div class="top-bar">
        <!-- .top-bar-brand -->
        <div class="top-bar-brand">
            <!-- toggle aside menu -->
            <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle aside menu -->
            <a href="{{ route('admin.index') }}">
                <img src="{{asset('admin/images/logo.png')}}" style="width: 79%;margin-left: 17px;">
            </a>
        </div><!-- /.top-bar-brand -->
        <!-- .top-bar-list -->
        <div class="top-bar-list">
            <!-- .top-bar-item -->
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                <!-- toggle menu -->
            </div><!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-full">
                <form action="{{ route('products.index')}}" method="get" style="width: 100%;">
                    <div class="input-group has-clearable">
                        <button type="button" class="close trigger-submit trigger-submit-delay" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                        </button>
                        <div class="input-group-prepend trigger-submit">
                            <span class="input-group-text"><span class="fas fa-search"></span></span>
                        </div>
                        <input type="text" class="form-control" name="s" value="" placeholder="Tìm kiếm">
                    </div>
                </form>
            </div><!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                <!-- .nav -->
                <ul class="header-nav nav">

                </ul><!-- /.nav -->
                <!-- .btn-account -->
                <div class="dropdown d-none d-md-flex">
                    <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="user-avatar user-avatar-md">
                            <img src="{{asset($current_user->avatar)}}" alt="">
                        </span>
                        <span class="account-summary pr-lg-4 d-none d-lg-block">
                            <a href="{{ route('users.index',$current_user->id)}}" class="account-name">{{ $current_user->name}}</a>
                            <span class="account-description">{{ $current_user->userGroup->name }}</span>
                        </span>
                    </button>
                    <div class="dropdown-menu">
                        <h6 class="dropdown-header d-none d-md-block d-lg-none"> {{ $current_user->name}} </h6>
                        <a class="dropdown-item" href="{{route('users.update',$current_user->id)}}/edit">
                            <span class="dropdown-icon oi oi-person"></span>
                            Thông tin cá nhân
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <span class="dropdown-icon oi oi-account-logout"></span>
                            Đăng xuất
                        </a>
                    </div><!-- /.btn-account -->
                </div><!-- /.top-bar-item -->
            </div><!-- /.top-bar-list -->
        </div><!-- /.top-bar -->
</header><!-- /.app-header -->