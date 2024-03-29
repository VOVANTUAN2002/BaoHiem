@extends('admin.layouts.master')

@section('content')

<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{route('insurances.index')}}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang Chủ</a>
            </li>
        </ol>
    </nav>
    <a href="" class="btn btn-success btn-floated"></a>
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto">Quản Lý Sản Phẩm - Thùng Rác</h1>
        <div class="btn-toolbar">
        </div>
    </div>
</header>

<div class="page-section">
    <div class="card card-fluid">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col">
                    <form action="" method="GET" id="form-search">
                        <div class="input-group input-group-alt">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#modalFilterColumnsProducts">Tìm nâng cao</button>
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
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#modalSaveSearchProducts" type="button">Lưu bộ lọc</button>
                            </div>
                        </div>
                        <!-- modalFilterColumns  -->
                        @include('admin.insurances.modals.modalFilterColumnsinsurances')
                    </form>
                    <!-- modalFilterColumns  -->
                    @include('admin.insurances.modals.modalSaveSearchinsurances')
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            @if (Session::has('success'))
                            <div class="alert alert-success mt-1">{{session::get('success')}}</div>
                            @endif
                            @if (Session::has('error'))
                            <div class="alert alert-danger mt-1">{{session::get('error')}}</div>
                            @endif
                            <tr>
                                <th>Tên</th>
                                <th>Gói hợp đồng</th>
                                <th>Tổng tiền</th>
                                <th>Chức năng </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insurances as $insurance)
                            <tr>
                                <td class="align-middle"> {{ $insurance->name }}</td>
                                @if( $insurance->contract_package == 'Term_life_insurance')
                                <td class="align-middle" value="Term_life_insurance">Bảo hiểm sinh kỳ</td>
                                @endif
                                @if( $insurance->contract_package == 'Term_insurance')
                                <td class="align-middle" value="Term_insurance">Bảo hiểm tử kỳ</td>
                                @endif
                                @if( $insurance->contract_package == 'Mixed_insurance')
                                <td class="align-middle" value="Mixed_insurance">Bảo hiểm hỗn hợp</td>
                                @endif
                                @if( $insurance->contract_package == 'Periodic_payment_insurance')
                                <td class="align-middle" value="Periodic_payment_insurance">Bảo hiểm trả tiền định kỳ</td>
                                @endif
                                @if( $insurance->contract_package == 'Lifetime_insurance')
                                <td class="align-middle" value="Lifetime_insurance">Bảo hiểm trọn đời</td>
                                @endif
                                <td class="align-middle"> {{number_format($insurance->total)}} {{ $insurance->unit }}</td>
                                <td>
                                    @if(Auth::user()->hasPermission('Insurance_restore'))
                                    <form action="{{ route('insurances.force_destroy',$insurance->id )}}" style="display:inline" method="post">
                                        <button onclick="return confirm('Xóa vĩnh viễn {{$insurance->name}} ?')" class="btn btn-sm btn-icon btn-secondary"><i class="far fa-trash-alt"></i></button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                    @endif
                                    @if(Auth::user()->hasPermission('Insurance_forceDelete'))
                                    <span class="sr-only">Edit</span></a> <a href="{{route('insurances.restore',$insurance->id)}}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-trash-restore"></i> <span class="sr-only">Remove</span></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <div class='float:right'>
                <ul class="pagination">
                    <span aria-hidden="true">{{ $insurances->links() }}</span>
                </ul>
            </div>
        </nav>
        @endsection