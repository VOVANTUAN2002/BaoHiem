@extends('admin.layouts.master')
@section('content')



<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{route('users.index')}}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Quản Lý Nhân
                    Viên</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title"> Chỉnh Sửa Nhân Viên<noscript></noscript> </h1>
</header>

<div class="page-section">
    <form method="post" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label> Số điện thoại </label> <input name="phone" type="phone" class="form-control" id="" placeholder="Nhập số điện thoại" value="{{ $user->phone }}">
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('phone') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="tf1"> Email </label> <input name="email" type="text" class="form-control" id="" placeholder="Nhập số điện thoại" value="{{ $user->email  }}">
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label> <input name="password" type="password" class="form-control" id="" placeholder="Nhập mật khẩu" value="">
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>
            <div class="card-body border-top">
                <legend>Thông tin cá nhân</legend>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label>Tên nhân viên<noscript></noscript></label>
                            <input name="name" type="text" class="form-control" id="" placeholder="Nhập tên nhân viên" value="{{ $user->name }}">
                            @if ($errors->any())
                            <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="d-block">Giới tính</label>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input type="radio" class="custom-control-input" name="gender" id="rd1" checked="" value="male">
                                <label class="custom-control-label" for="rd1">Nam</label>
                            </div>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input type="radio" class="custom-control-input" name="gender" id="rd2" value="female">
                                <label class="custom-control-label" for="rd2">Nữ</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh <noscript></noscript></label>
                            <input name="day_of_birth" type="date" class="form-control" id="" placeholder="Nhập ngày sinh " value="{{ $user->day_of_birth }}">
                            @if ($errors->any())
                            <p style="color:red">{{ $errors->first('day_of_birth') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Hình ảnh nhân viên</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <div class="card card-figure">
                            <figure class="figure">
                                <div class="figure-img">
                                    <img class="img-fluid" src="/{{ $user->avatar}}">
                                    <a target="_blank" href="/{{ $user->avatar}}" class="img-link" data-size="600x450">
                                        <span class="tile tile-circle bg-danger"><span class="oi oi-eye"></span></span>
                                    </a>
                                    <div class="figure-action">
                                        <a href="javascript:;" class="btn btn-block btn-sm btn-primary">Xóa</a>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label> Địa chỉ </label> <input name="address" type="text" class="form-control" id="" placeholder="Nhập địa chỉ" value="{{ $user->address }}">
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('address') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Ngày làm việc</label> <input name="start_day" type="date" class="form-control" id="" placeholder="Nhập ngày làm việc" value="{{ $user->start_day }}">
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('start_day') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Ghi chú</label> <input name="note" type="text" class="form-control" id="" placeholder="Nhập ghi chú" value="{{ $user->note }}">
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('note') }}</p>
                    @endif
                </div>
            </div>
            <div class="card-body border-top">
                <legend>Thông tin liên hệ</legend>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nhóm nhân viên</label>
                            <select class="form-select form-control" name="user_group_id">

                                @foreach($userGroups as $userGroup)
                                <option value="{{ $userGroup->id }}" @selected($userGroup->id == $user->user_group_id)>
                                    {{ $userGroup->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->any())
                            <p style="color:red">{{ $errors->first('user_group_id') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-secondary float-right" onclick="window.history.go(-1); return false;">Hủy</button>
                    <button class="btn btn-primary ml-auto" type="submit">Cập nhật</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection