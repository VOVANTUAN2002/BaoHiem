<!-- #modalFilterColumnsProducts -->
<div class="modal fade" id="modalFilterColumnsProducts" tabindex="-1" role="dialog" aria-labelledby="modalFilterColumnsProductsLabel" aria-hidden="true">
    <!-- .modal-dialog -->
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <!-- .modal-content -->
        <div class="modal-content">
            <!-- .modal-header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterColumnsProductsLabel"> Lọc nâng cao </h5>
            </div><!-- /.modal-header -->
            <!-- .modal-body -->
            <div class="modal-body">
                <!-- #filter-columns -->
                <div id="filter-columns">
                    <!-- .form-row -->
                    <div class="form-group form-row filter-row">
                        <div class="col-lg-4">
                            <label class="">Tên sản phẩm</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="input text">
                                <input type="text" name="filter[name]" class="form-control filter-column f-name" value=" {{ (isset($filter['name']) ? $filter['name'] : '') }} " id="name" />
                            </div>
                        </div>
                    </div>
                    <!-- .form-row -->
                    <div class="form-group form-row filter-row">
                        <div class="col-lg-4">
                            <label class="">Tỉnh/Thành phố</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="input text">
                                <select name="filter[province_id]" class="form-control province_id">
                                    <option value="">Vui lòng chọn</option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" @selected(isset($filter['province_id']) ? ($province->id == $filter['province_id']) : false)>
                                        {{$province->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- .form-row -->
                    <div class="form-group form-row filter-row">
                        <div class="col-lg-4">
                            <label class="">Quận/Huyện</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="input text">

                                <select name="filter[district_id]" class="form-control district_id">
                                    <option value="">Vui lòng chọn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- .form-row -->
                    <div class="form-group form-row filter-row">
                        <div class="col-lg-4">
                            <label class="">Phường/Xã</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="input text">
                                <select name="filter[district_id]" class="form-control district_id">
                                    <option value="">Vui lòng chọn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- .form-row -->
                    <div class="form-group form-row filter-row">
                        <div class="col-lg-4">
                            <label class="">Chi nhánh </label>
                        </div>
                        <div class="col-lg-8">
                            <div class="input text">
                                <select name="filter[branch_id]" class="form-control branch_id">
                                    <option value="">Vui lòng chọn</option>

                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" @selected( isset($filter['branch_id']) ? ($branch->id == $filter['branch_id']) : false )
                                        >{{$branch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-row filter-row">
                        <div class="col-lg-4">
                            <label class="">Tình trạng </label>
                        </div>
                        <div class="col-lg-8">
                            <div class="input text">
                                <select name="filter[status]" class="form-control status">
                                    <option value="">Vui lòng chọn</option>
                                    <option value="draft" @selected( isset($filter['status']) ? ($filter['status'] == 'draft') : false)>Bản Thảo</option>
                                    <option value="sold" @selected( isset($filter['status']) ? ($filter['status'] == 'sold') : false)>Đã Bán</option>
                                    <option value="selling" @selected( isset($filter['status']) ? ($filter['status'] == 'selling') : false)>Đang Bán</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-row filter-row">
                        <div class="col-lg-4">
                            <label class="">Loại sản phẩm </label>
                        </div>
                        <div class="col-lg-8">
                            <div class="input text">
                                <select name="filter[product_type]" class="form-control product_type">
                                    <option value="">Tất Cả</option>
                                    <option value="hot_products" @selected( isset($filter['product_type']) ? ($filter['product_type'] == 'hot_products') : false)>Sản Phẩm Hot</option>
                                    <option value="block_products" @selected( isset($filter['product_type']) ? ($filter['product_type'] == 'block_products') : false) >Sản Phẩm Block</option>
                                    <option value="delivery_products" @selected( isset($filter['product_type']) ? ($filter['product_type'] == 'delivery_products') : false)>Sản Phẩm Ký Gửi</option>
                                    <option value="future_products" @selected( isset($filter['product_type']) ? ($filter['product_type'] == 'future_products') : false)>Chuẩn Bị Mở Bán</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><!-- #filter-columns -->
                <!-- .btn -->
            </div><!-- /.modal-body -->
            <!-- .modal-footer -->
            <div class="modal-footer justify-content-start">
                <button type="submit" class="btn btn-primary" id="apply-filter">Áp dụng</button>
                <a href="{{ route('products.index') }}" class="btn btn-dark ">Đặt lại</a>
                <button type="button" data-dismiss="modal" class="btn btn-secondary ml-auto" id="clear-filter">Hủy</button>
            </div><!-- /.modal-footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /#modalFilterColumnsProducts -->


<script>
    jQuery(document).ready(function() {

        jQuery('.province_id').on('change', function() {
            var province_id = jQuery(this).val();

            $.ajax({
                url: "/api/get_districts/" + province_id,
                type: "GET",
                success: function(data) {
                    var districts_html = '<option value="">Vui lòng chọn</option>';
                    for (const district of data) {
                        districts_html += '<option value="' + district.id + '">' +
                            district.name + '</option>';
                    }
                    jQuery('.district_id').html(districts_html);
                }
            });
        });

        jQuery('.district_id').on('change', function() {
            var district_id = jQuery(this).val();

            $.ajax({
                url: "/api/get_wards/" + district_id,
                type: "GET",
                success: function(data) {
                    var wards_html = '<option value="">Vui lòng chọn</option>';
                    for (const ward of data) {
                        wards_html += '<option value="' + ward.id + '">' + ward.name + '</option>';
                    }
                    jQuery('.ward_id').html(wards_html);
                }
            });
        });
        jQuery('.branch_id').on('change', function() {
            var branch_id = jQuery(this).val();
            $.ajax({
                url: "/api/get_users_by_branch_id/" + branch_id,
                type: "GET",
                success: function(data) {
                    var branches_html = '';
                    for (const user of data) {
                        branches_html += '<option value="' + user.id + '">' + user.name + '</option>';
                    }
                    jQuery('.user_id').html(branches_html);
                }
            });
        });

    });
</script>