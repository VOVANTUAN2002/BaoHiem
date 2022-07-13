@extends('admin.layouts.login')
@section('content')
<form action="{{ route('postLogin') }}" method="post" class="auth-form">
  @csrf
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
    <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
  </div><!-- /.form-group -->
  <!-- .form-group -->
  <div class="form-group text-center">
    <div class="custom-control custom-control-inline custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="remember-me"> <label class="custom-control-label" for="remember-me">Lưu thông tin</label>
    </div>
  </div><!-- /.form-group -->
  <!-- recovery links -->

</form><!-- /.auth-form -->


@endsection