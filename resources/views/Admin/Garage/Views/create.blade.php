<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('garage.create')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('admin/garage') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">@lang('garage.name')</label>
                                    <input required type="text" class="form-control" name="name" id="name"
                                        placeholder="@lang('garage.name')">
                                </div>
                                <div class="col-md-6">
                                    <label for="name_ar">@lang('garage.name_ar')</label>
                                    <input required type="text" class="form-control" name="name_ar" id="name_ar"
                                        placeholder="@lang('garage.name_ar')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="site_number">@lang('garage.site_number')</label>
                                    <input required type="text" class="form-control" name="site_number"
                                        id="site_number" placeholder="@lang('garage.site_number')">
                                </div>
                                {{-- <div class="col-md-6">
                                    <label for="voucher_valid_hours">@lang('garage.voucher_valid_hours')</label>
                                    <input required type="number" min="1" max="24" value="1"
                                        class="form-control" name="voucher_valid_hours" id="voucher_valid_hours"
                                        placeholder="@lang('garage.voucher_valid_hours')">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('garage.submit')</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
