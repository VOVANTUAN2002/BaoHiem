@extends('admin.layouts.master')
@section('content')

<!-- .page-title-bar -->
<header class="page-title-bar">
    @if (Session::has('succes'))
    <div class="alert alert-success">{{session::get('succes')}}</div>
    @endif
    <div class="d-flex flex-column flex-md-row">

        <p class="lead">
            <span class="font-weight-bold">Xin chào, .</span>
            <span class="d-block text-muted">Chúc bạn một ngày làm việc tốt lành !</span>
        </p>
        <div class="ml-auto">

        </div>
    </div>
</header><!-- /.page-title-bar -->
<!-- .page-section -->
<div class="page-section">
    <!-- .section-block -->
    <div class="section-block">
        <!-- metric row -->
        <div class="metric-row">
            <div class="col-lg-12">
                <div class="metric-row metric-flush">
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:;" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Tổng Số Bảo Hiểm </h2>
                            <p class="metric-value h3">
                                <span class="value"></span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:;" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Tổng Khách Hàng </h2>
                            <p class="metric-value h3">
                                <span class="value"></span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:;" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Tổng Doanh Thu </h2>
                            <p class="metric-value h3">
                                <span class="value"> </span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                </div>
            </div><!-- metric column -->
        </div><!-- /metric row -->

    </div><!-- /.section-block -->
</div><!-- /.page-section -->

@endsection