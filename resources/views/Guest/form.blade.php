<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('guest.create', ['garage_name' => request()->user->garage->name])</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('guest/final-client/registration') }}" method="POST">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ request()->user->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="name">@lang('guest.name')</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="@lang('guest.name')" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">@lang('guest.phone')</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="@lang('guest.phone')" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('guest.submit')</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
