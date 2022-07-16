@extends('admin.layouts.master')

@section('content')


<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang Chủ</a>
            </li>
        </ol>
    </nav>
    <a href="{{route('userGroups.index')}}" class="btn btn-success btn-floated"> </a>
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto"> Quản Lý Nhóm Nhân Viên - Thùng Rác</h1><!-- .btn-toolbar -->
        <div class="btn-toolbar">

        </div>
    </div>
</header>
<div class="page-section">
    <div class="card card-fluid">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link " href="{{route('userGroups.index')}}">Tất Cả</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active " href="{{route('userGroups.trash')}}">Thùng Rác</a>
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
                        @include('admin.userGroups.modals.modalFilterColumns')
                    </form>
                    <!-- modalFilterColumns  -->
                    @include('admin.userGroups.modals.modalSaveSearch')
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
                            <th> Tên nhóm</th>
                            <th> Miêu tả nhóm </th>
                            <th> Chức năng </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userGroups as $userGroup)
                        <tr>
                            <td class="align-middle"> {{ $userGroup->id }} </td>
                            <td class="align-middle"> {{ $userGroup->name }} </td>
                            <td class="align-middle"> {{ $userGroup->description }} </td>
                            <td>
                                @if(Auth::user()->hasPermission('UserGroup_forceDelete'))
                                <form action="{{ route('userGroups.force_destroy',$userGroup->id )}}" style="display:inline" method="post">
                                    <button onclick="return confirm('Xóa vĩnh viễn {{$userGroup->name}} ?')" class="btn btn-sm btn-icon btn-secondary"><i class="far fa-trash-alt"></i></button>
                                    @csrf
                                    @method('delete')
                                </form>
                                @endif
                                @if(Auth::user()->hasPermission('UserGroup_restore'))
                                <span class="sr-only">Edit</span></a> <a href="{{route('userGroups.restore',$userGroup->id)}}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-trash-restore"></i> <span class="sr-only">Remove</span></a>
                                @endif
                            </td>
                        </tr><!-- /tr -->
                        @endforeach
                    </tbody><!-- /tbody -->
                </table><!-- /.table -->
            </div>
            <div style="float:right">
                {{ $userGroups->links() }}
            </div>
        </div><!-- /.card-body -->
        @endsection