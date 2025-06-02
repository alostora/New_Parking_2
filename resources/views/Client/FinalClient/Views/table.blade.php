<section class="content">

    <div class="box box-info">
        <!-- filter -->
        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('final_client.page_title')</h3>
            <div class="col-md-4">

            </div>
        </div>
        <div class="box box-success">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('client.total_customer_count') : {{ auth()->user()->availableCustomerCount }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('client.used_customer_count') : {{ auth()->user()->totalUsedCustomer }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('client.available_customer_count') : {{ auth()->user()->totalAvailableCustomer }}
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
                        <th>@lang('final_client.name')</th>
                        <th>@lang('final_client.phone')</th>
                        <th>@lang('final_client.garage')</th>
                        <th>@lang('final_client.created_at')</th>
                        {{-- <th>@lang('final_client.related_client')</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($final_clients))
                        @foreach ($final_clients as $key => $finalClient)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $finalClient->name }} </td>
                                <td> {{ $finalClient->phone }} </td>
                                <td> {{ $finalClient->garage->name }} </td>
                                <td> {{ $finalClient->created_at }} </td>
                                {{-- <td> {{ $finalClient->client->name }} </td> --}}
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $final_clients->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>

        </div>
    </div>
</section>
