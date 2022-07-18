@extends('admin.layouts.master')

@section('content')


<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{route('admin.index')}}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang Chủ</a>
            </li>
        </ol>
    </nav>
    <a href="{{route('users.index')}}" class="btn btn-success btn-floated"> </a>
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto"> Quản Lý Nhân Viên</h1><!-- .btn-toolbar -->
        <div class="btn-toolbar">
            @if(Auth::user()->hasPermission('User_create'))
            <a href="{{ route('users.create') }}" class="btn btn-primary mr-2">
                <i class="fa-solid fa fa-plus"></i>
                <span class="ml-1">Thêm Mới</span>
            </a>
            <?php 
            // <a href="{{ route('users.import') }}" class="btn btn-primary ">
            //     <i class='fas fa-file-alt'></i>
            //     <span class="ml-1">Nhập file excel</span>
            // </a>
            ?>
            @endif
        </div>

    </div>
</header>
<div class="page-section">
    <div class="card card-fluid">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link <?= ($user_role == 'all') ? 'active' : '' ?>">Tất Cả</a>
                </li>
                @foreach($userGroups as $userGroup)
                <li class="nav-item">
                    <a href="{{route('users.user_role',$userGroup->id)}}" class="nav-link <?= ($user_role == $userGroup->id) ? 'active' : '' ?>">
                        {{$userGroup->name}}
                    </a>
                </li>
                @endforeach
                <li class="nav-item">
                    <a href="{{route('users.trash')}}" class="nav-link">Thùng Rác</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col">
                    <form action="" method="GET" id="form-search">
                        <div class="input-group input-group-alt">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#modalFilterColumns">Tìm nâng cao</button>
                            </div>
                            <div class="input-group has-clearable">
                                <button type="button" class="close trigger-submit trigger-submit-delay" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                                </button>
                                <div class="input-group-prepend trigger-submit">
                                    <span class="input-group-text"><span class="fas fa-search"></span></span>
                                </div>
                                <input type="text" class="form-control" name="s" value="" placeholder="Tìm nhanh theo cú pháp (ma:Mã kết quả hoặc ten:Tên kết quả)">
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#modalSaveSearch" type="button">Lưu bộ lọc</button>
                            </div>
                        </div>
                        <!-- modalFilterColumns  -->
                        @include('admin.users.modals.modalFilterColumns')
                    </form>
                    <!-- modalFilterColumns  -->
                    @include('admin.users.modals.modalSaveSearch')
                </div>
            </div>
            @if (Session::has('success'))
            <div class="alert alert-success">{{session::get('success')}}</div>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Tên nhân viên</th>
                            <th> Số điện thoại</th>
                            <th> Nhóm nhân viên</th>
                            <th> Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="align-middle"> {{ $user->id }} </td>
                            <td class="align-middle"> {{ $user->name }} </td>
                            <td class="align-middle"> {{ $user->phone }} </td>
                            <td class="align-middle"> {{ $user->userGroup->name }} </td>
                            <td>
                                @if(Auth::user()->hasPermission('User_delete'))
                                @if($user->id != 2)
                                <form action="{{ route('users.destroy',$user->id )}}" style="display:inline" method="post">
                                    <button onclick="return confirm('Xóa {{$user->name}} ?')" class="btn btn-sm btn-icon btn-secondary">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    @csrf
                                    @method('delete')
                                </form>
                                @endif
                                @endif

                                @if(Auth::user()->hasPermission('User_update'))
                                @if($user->id != 2)
                                <span class="sr-only">Edit</span></a> <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Remove</span></a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div style="float:right">
                    {{ $users->links() }}
                </div>

            </div>

            @endsection
