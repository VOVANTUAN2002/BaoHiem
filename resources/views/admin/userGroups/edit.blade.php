@extends('admin.layouts.master')
@section('content')
<!-- .page-title-bar -->
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{route('userGroups.index')}}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Quản Lý Nhóm Nhân viên</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title"> Chỉnh Sửa Nhóm Nhân Viên </h1>
</header>

<div class="page-section">
    <div class="d-xl-none">
        <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
    </div>
    <div id="base-style" class="card">
        <div class="card-body">
            <form method="post" action="{{route('userGroups.update',$userGroup->id)}}">
                @csrf
                @method('PUT')
                <fieldset>
                    <div class="form-group">
                        <label for="tf1">Tên nhóm</label> <input type="text" name="name" value="{{ $userGroup->name }}" class="form-control" placeholder="nhập tên nhóm nhân viên"> <small class="form-text text-muted"></small>
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tf1"> Mô tả </label>
                        <textarea name="description" class="form-control" >{{ $userGroup->description }}</textarea>

                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('description') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tf1">Quyền hạn </label>
                        <div class="row">
                            @foreach ($group_names as $group_name => $roles)
                            <div class="list-group list-group-flush list-group-bordered col-lg-4" >
                                <div class="list-group-header"> {{ __($group_name) }} </div>
                                @foreach ($roles as $role)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ __($role['name']) }}</span> 
                                    <!-- .switcher-control -->
                                    <label class="switcher-control">
                                        <input type="checkbox" 
                                        @checked( in_array($role['id'],$userRoles) )
                                        name="roles[]" class="switcher-input" value="{{ $role['id'] }}" > 
                                        <span class="switcher-indicator"></span>
                                    </label> 
                                    <!-- /.switcher-control -->
                                </div>
                            @endforeach
                            </div>
                            @endforeach
                        </div>
                       
                    </div>
                </fieldset>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>

                    </div>
                    <div class="col-lg-6">
                        <button style="float: right;" class="btn btn-primary" type="submit">Cập nhật<noscript></noscript> </button>

                    </div>
                </div>


            </form>

        </div>
    </div>
</div>
@endsection