<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('client.create')</h3>
                </div>
                <form role="form" action="{{ url('admin/client') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="country_id">@lang('client.country')</label>
                                    <select class="form-control select2" name="country_id" id="country_id"
                                        onchange="getGovernorate(this.value)" required>
                                        <option value="">@lang('filter.select')</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6" id="parent_governorate_id">
                                    <label for="governorate_id">@lang('client.governorate')</label>
                                    <select class="form-control select2" name="governorate_id" id="governorate_id"
                                        required></select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">

                                    <label for="name">@lang('client.name')</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="@lang('client.name')" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">@lang('client.email')</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="@lang('client.email')" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="phone">@lang('client.phone')</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="@lang('client.phone')" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="password">@lang('client.password')</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="@lang('client.password')" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="garage_id">@lang('client.garage')</label>
                                    <select class="form-control select2" name="garage_id" id="garage_id" required>
                                        <option value="">@lang('filter.select')</option>
                                        @foreach ($garages as $garage)
                                            <option value="{{ $garage->id }}">{{ $garage->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="available_customer_count">@lang('client.available_customer_count')</label>
                                    <input type="number" class="form-control" name="available_customer_count"
                                        id="available_customer_count" value="0" required>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="voucher_valid_hours">@lang('client.voucher_valid_hours')</label>
                                    <input required type="number" min="1" max="24" value="1"
                                        class="form-control" name="voucher_valid_hours" id="voucher_valid_hours"
                                        placeholder="@lang('client.voucher_valid_hours')">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('client.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
    function getGovernorate(country_id) {

        $("#parent_governorate_id").hide();
        if (country_id != "") {

            $.ajax({

                url: '{{ url('admin/country-governorates') }}/' + country_id,
                type: 'GET',
                data: {},
                dataType: 'json',
                success: function(response) {

                    let result = response.data;
                    if (result.length > 0) {

                        $("#governorate_id").html(`<option value=''>@lang('filter.select')</option>`)

                        for (let i = 0; i < result.length; i++) {

                            $("#governorate_id").append(
                                `<option value='${result[i].id}'>${result[i].name}</option>`);

                        }

                        $("#parent_governorate_id").show();

                    }
                },
                error: function(request, error) {
                    console.log("Request: " + JSON.stringify(request));
                }
            });
        }
    }
</script>
