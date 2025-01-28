<!-- Main content -->
<section class="content" style="text-align:center">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('guest.please_save_qr_code')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div>
                    {!! $finalClient->final_client_qr !!}
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">@lang('guest.submit')</button>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
