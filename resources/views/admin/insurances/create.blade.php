@extends('admin.layouts.master')
@section('content')

<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{route('insurances.index')}}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trở Lại</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title"></h1>
</header>
@if (Session::has('success'))
<div class="alert alert-success mt-1">{{session::get('success')}}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger mt-1">{{session::get('error')}}</div>
@endif
<div class="page-section">
    <form id="insurance-app" method="post" action="{{route('insurances.store')}}" enctype="multipart/form-data">
        @csrf
        {{ csrf_field() }}
        <div class="card">
            <div class="card-body border-top">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label for="tf1">Số hợp đồng <abbr title="Trường bắt buộc">*</abbr></label>
                    <input name="contract" type="text" class="form-control" placeholder="Nhập số" value="{{ old('contract') }}">
                    <small class="form-text text-muted">Tối thiểu 30 ký tự, tối đa 99 ký tự</small>
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('contract') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="tf1">Họ tên khách hàng </label>
                            <input name="name" type="text" class="form-control" placeholder="nhập tên khách hàng" value="{{ old('name') }}"></input>
                            @if ($errors->any())
                            <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="tf1">Email </label>
                            <input name="email" type="text" class="form-control" placeholder="nhập email khách hàng" value="{{ old('email') }}"></input>
                            @if ($errors->any())
                            <p style="color:red">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="tf1">Số điện thoại </label>
                            <input name="phone" type="text" class="form-control" placeholder="nhập số ĐT khách hàng" value="{{ old('phone') }}"></input>
                            @if ($errors->any())
                            <p style="color:red">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tf1">Địa chỉ khách hàng <abbr title="Trường bắt buộc">*</abbr></label>
                    <textarea id="summernote" data-toggle="summernote" name="description" type="text" class="form-control" placeholder="Nhập mô tả chung về bất động sản của bạn. Ví dụ: Khu nhà có vị trí thuận lợi, gần công viên, gần trường học ... ">{{ old('description') }}</textarea>
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('description') }}</p>
                    @endif
                </div>
                <div class="card-body border-top">
                    <legend>Chi tiết Bảo Hiểm</legend>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tiền Bảo Hiểm</label>
                                <select name="paid_and_unpaid_amount" class="form-control" id="insurance_type" v-model="insurance_type">
                                    <option value="Paid" @selected(old('paid_and_unpaid_amount')=='Paid' )>Đã thanh toán</option>
                                    <option value="Amount_unpaid" @selected(old('paid_and_unpaid_amount')=='Amount_unpaid' )>Số tiền chưa thanh toán</option>
                                </select>
                                @if ($errors->any())
                                <p style="color:red">{{ $errors->first('paid_and_unpaid_amount') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Ngày ký Bảo Hiểm</label>
                            <div class="form-group">
                                <label class="switcher-control">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" class="switcher-input insurance_open" value="1" @checked( old('insurance_open')==1 ) v-model="insurance_open">
                                    <span class="switcher-indicator"></span>
                                </label>
                                @if ($errors->any())
                                <p style="color:red">{{ $errors->first('insurance_open') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3" v-show="insurance_open">
                            <div class="form-group">
                                <label for="tf1">Ngày ký</label> <input name="insurance_start_date" type="date" class="form-control" placeholder="" value="{{ old('insurance_start_date') }}">
                                @if ($errors->any())
                                <p style="color:red">{{ $errors->first('insurance_start_date') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3" v-show="insurance_open">
                            <div class="form-group">
                                <label for="tf1">Ngày kết thúc</label> <input name="insurance_start_date_payment" type="date" class="form-control" placeholder="" value="{{ old('insurance_start_date_payment') }}">
                                @if ($errors->any())
                                <p style="color:red">{{ $errors->first('insurance_start_date_payment') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top" v-show="insurance_type != 'Paid'">
                    <legend>Thông tin chi tiết</legend>
                    <div class="row">
                        <div class="col-lg-4" v-show="insurance_type == 'Amount_unpaid'">
                            <div class="form-group">
                                <label for="tf1">Ngày thanh toán</label> <input name="insurance_open_date_Paid" type="date" class="form-control" placeholder="" value="{{ old('insurance_open_date_Paid') }}">
                                @if ($errors->any())
                                <p style="color:red">{{ $errors->first('insurance_open_date_Paid') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <legend>Thông tin Bảo Hiểm</legend>
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label>Tổng mức giá <abbr title="Trường bắt buộc">*</abbr></label>
                                <input name="total" type="text" class="form-control" placeholder="Nhập giá, VD 12000000" value="{{ old('total') }}" data-mask="currency">
                                @if ($errors->any())
                                <p style="color:red">{{ $errors->first('total') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Đơn vị</label>
                                <select name="unit" class="form-control">
                                    <option value="VND" @selected( old('unit')=='VND' )>VND</option>
                                    <option value="VND" @selected( old('unit')=='VND' )>Giá / người</option>
                                </select>
                                @if ($errors->any())
                                <p style="color:red">{{ $errors->first('unit') }}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="d-block">Gói hợp đồng</label>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input type="radio" class="custom-control-input" name="contract_package" id="rd1" @checked( old('contract_package')=='Term_life_insurance' || old('contract_package')=='' ) value="Term_life_insurance">
                            <label class="custom-control-label" for="rd1">Bảo hiểm sinh kỳ</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input type="radio" class="custom-control-input" name="contract_package" id="rd2" @checked( old('contract_package')=='Term_insurance' ) value="Term_life_insurance">
                            <label class="custom-control-label" for="rd2">Bảo hiểm tử kỳ</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input type="radio" class="custom-control-input" name="contract_package" id="rd3" @checked( old('contract_package')=='Mixed_insurance' ) value="Mixed_insurance">
                            <label class="custom-control-label" for="rd3">Bảo hiểm hỗn hợp</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input type="radio" class="custom-control-input" name="contract_package" id="rd4" @checked( old('contract_package')=='Periodic_payment_insurance' ) value="Periodic_payment_insurance">
                            <label class="custom-control-label" for="rd4">Bảo hiểm trả tiền định kỳ</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input type="radio" class="custom-control-input" name="contract_package" id="rd5" @checked( old('contract_package')=='Lifetime_insurance' ) value="Lifetime_insurance">
                            <label class="custom-control-label" for="rd5">Bảo hiểm trọn đời</label>
                        </div>
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('contract_package') }}</p>
                        @endif
                    </div>
                </div>
                <div class="card-body border-top">
                    <legend>Hình ảnh & Video</legend>
                    <div class="form-group">
                        <label><b>Chọn hình ảnh Hợp Đồng nếu có</b></label>
                        <input type="file" name="photo_contract" class="form-control" value="{{ old('photo_contract') }}" multiple>
                    </div>
                    <div class="form-group">
                        <label for="tf1">Thêm video từ Youtube</label>
                        <input name="linkYoutube" type="text" class="form-control" placeholder="VD: https://www.youtube.com/watch?v=Y-Dw0NpfRug" value="{{ old('linkYoutube') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('linkYoutube') }}</p>
                        @endif
                    </div>
                    <label><b>Chọn hình ảnh CMND nếu có</b></label>
                    <div class="form-group">
                        <label>Chọn hình ảnh CMND khách hàng</label>
                        <input type="file" name="photo_CMND" class="form-control" value="{{ old('photo_CMND') }}" multiple>
                    </div>
                    <div class="form-group">
                        <label for="tf1">Thêm video từ Youtube</label>
                        <input name="linkYoutube" type="text" class="form-control" placeholder="VD: https://www.youtube.com/watch?v=Y-Dw0NpfRug" value="{{ old('linkYoutube') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('linkYoutube') }}</p>
                        @endif
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="form-actions">
                        <a class="btn btn-secondary float-right" href="{{route('insurances.index')}}">Hủy</a>
                        <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                    </div>
                </div>
            </div>
    </form>
</div>
<script>
    var app_odds = new Vue({
        el: '#insurance-app',
        data: {
            Amount_unpaids: [],
            insurance_type: '<?= old('insurance_type') ?? 'Paid'; ?>',
            insurance_open: <?= old('insurance_open') ?? 0; ?>,
        }
    });
</script>
@endsection