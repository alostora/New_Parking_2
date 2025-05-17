<section class="content">
    <div class="box box-info">
        <!-- filter -->
        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('garage.page_title')</h3>
            <div class="col-md-4">
                <a href="{{ url('admin/garage/create') }}" class="btn bg-olive btn-sm">
                    <i class="fa fa-plus"></i>
                    <span>@lang('garage.create')</span>
                </a>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('general.total') : {{ $count_inactive + $count_active }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('general.active') : {{ $count_active }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('general.inactive') : {{ $count_inactive }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('garage.name')</th>
                        <th>@lang('garage.name_ar')</th>
                        <th>@lang('garage.site_number')</th>
                        <th>@lang('garage.voucher_valid_hours')</th>
                        <th>@lang('garage.operations')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($garages))
                        @foreach ($garages as $key => $garage)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $garage->name }} </td>
                                <td> {{ $garage->name_ar }} </td>
                                <td> {{ $garage->site_number }} </td>
                                <td> {{ $garage->voucher_valid_hours }} </td>
                                <td>
                                    <a href="{{ url('admin/garage/edit/' . $garage->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @if ($garage->stopped_at == null)
                                        <a href="{{ url('admin/garage-inactive/' . $garage->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> @lang('garage.active')
                                        </a>
                                    @else
                                        <a href="{{ url('admin/garage-active/' . $garage->id) }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-close"></i> @lang('garage.inactive')
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $garages->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
    </div>
</section>
