@extends('admin.layouts.login')
@section('content')
<form action="{{ route('register') }}" method="POST" class="auth-form">
    <?php //Hiển thị thông báo thành công
    ?>
    @if ( Session::has('success') )
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ Session::get('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    @endif
    <?php //Hiển thị thông báo lỗi
    ?>
    @if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{ Session::get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    @endif
    @csrf
    <div class="form-group">
        @if (Session::has('success'))
        <div class="alert alert-danger">{{session::get('success')}}</div>
        @endif
        <div class="form-label-group">
            <input type="text" id="inputUser" class="form-control" name="name" value="{{old('name')}}" placeholder="Họ và tên" autofocus=""> <label for="inputUser">Họ và tên</label>
            @if (Session::has('error_name'))
            <div class="alert alert-danger">{{session::get('error_name')}}</div>
            @endif
            <div class="error-message">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>
    </div><!-- /.form-group -->
    <!-- .form-group -->
    <div class="form-group">
        @if (Session::has('success'))
        <div class="alert alert-danger">{{session::get('success')}}</div>
        @endif
        <div class="form-label-group">
            <input type="text" id="inputUser" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Số điện thoại" autofocus=""> <label for="inputUser">Số điện thoại</label>
            @if (Session::has('error_phone'))
            <div class="alert alert-danger">{{session::get('error_phone')}}</div>
            @endif
            <div class="error-message">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('phone') }}</p>
                @endif
            </div>
        </div>
    </div><!-- /.form-group -->
    <!-- .form-group -->
    <div class="form-group">
        @if (Session::has('success'))
        <div class="alert alert-danger">{{session::get('success')}}</div>
        @endif
        <div class="form-label-group">
            <input type="text" id="inputUser" class="form-control" name="email" value="{{old('email')}}" placeholder="Email" autofocus=""> <label for="inputUser">Email</label>
            @if (Session::has('error_email'))
            <div class="alert alert-danger">{{session::get('error_email')}}</div>
            @endif
            <div class="error-message">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
    </div><!-- /.form-group -->
    <!-- .form-group -->
    <div class="form-group">
        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" name="password" value="{{old('password')}}" placeholder="Mật khẩu"> <label for="inputPassword">Mật khẩu</label>

            @if (Session::has('error_password'))
            <div class="alert alert-danger">{{session::get('error_password')}}</div>
            @endif
            <div class="error-message">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('password') }}</p>
                @endif
            </div>
        </div>
    </div><!-- /.form-group -->
    <!-- .form-group -->
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng ký</button>
    </div><!-- /.form-group -->

    <!-- .form-group -->

    <!-- recovery links -->
    <div class="form-group">
        <p>Đăng nhập <a href="{{ url('/administrator/login') }}"> tại đây</a></p>
    </div><!-- /.form-group -->
    <div class="form-group text-center">
        <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember-me"> <label class="custom-control-label" for="remember-me">Lưu thông tin</label>
        </div>
    </div><!-- /.form-group -->
</form><!-- /.auth-form -->
@endsection