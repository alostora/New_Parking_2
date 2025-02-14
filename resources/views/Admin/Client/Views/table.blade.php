<section class="content">

    <div class="box box-info">
        <!-- filter -->
        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('client.page_title')</h3>
            <div class="col-md-4">
                <a href="{{ url('admin/client/create') }}" class="btn bg-olive btn-sm"
                    style="height:25px;padding:2px;width:150px">
                    <i class="fa fa-plus"></i>
                    <span>@lang('client.create')</span>
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
                                @lang('client.active') : {{ $count_active }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('client.inactive') : {{ $count_inactive }}
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
                        <th>@lang('client.name')</th>
                        <th>@lang('client.phone')</th>
                        <th>@lang('client.country')</th>
                        <th>@lang('client.available_customer_count')</th>
                        <th>@lang('client.operations')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($users))
                        @foreach ($users as $key => $user)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td onclick="PrintQr('{{ $user->name }}','{{ $user->id }}')">
                                    <div id="{{ $user->id }}">
                                        {!! $user->client_qr !!}
                                    </div>
                                </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->phone }} </td>
                                <td> {{ $user->country ? $user->country->name : '' }} </td>
                                <td> {{ $user->available_customer_count }} </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('admin/client/edit/' . $user->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        @if ($user->stopped_at == null)
                                            <a href="{{ url('admin/client-inactive/' . $user->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i> @lang('general.active')
                                            </a>
                                        @else
                                            <a href="{{ url('admin/client-active/' . $user->id) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-close"></i> @lang('general.inactive')
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $users->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>

        </div>
    </div>
</section>

<script>
    function PrintQr(companyName, companyId) {

        var mywindow = window.open(" ", "PRINT");

        mywindow.document.write(

            `<html lang="en">
                <head>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }
                        html {
                            font-size: 10px;
                        }
                        body {
                            font-family: "cairo", "sans-serif", "Marhey";
                        }

                        .smil_bg {
                            width: 234px;
                            height: 234px;
                            border-radius: 50%;
                            background-color: yellow;
                            display: flex;
                            justify-content: center;
                            text-align: center;
                            align-items: center;
                            margin-top:45%;
                        }
                        .smiley-face {
                            width: 220px;
                            height: 220px;
                            border-radius: 50%;
                            background-color: yellow;
                            position: relative;
                            border: 6px solid black;
                        }
                        .rate_me {
                            position: absolute;
                            top: 9%;
                            left: 40%;
                            right: -50%;
                            width: 15%;
                            height: 15%;
                            display: flex;
                            justify-content: center;
                            text-align: center;
                            align-items: center;
                        }
                        .font-style {
                            font-family: Marhey ;
                            font-size: xx-large;
                            font-style: oblique;
                            font-weight: 400;
                        }
                        .style_font_1{
                            position: absolute;
                            top: 13.8%;
                            right: 20.7%;
                            width:4%;
                            height: 11px;
                            border-radius: 25px;
                            border: 7px solid black;
                            rotate: -15deg;
                        }
                        .style_font_2{
                            position: absolute;
                            top: 16.6%;
                            left: 43.8%;
                            width: 6%;
                            height: 12px;
                            border-radius: 25px;
                            border: 7px solid black;
                            rotate: 15deg;
                        }
                        .img{
                            position: absolute;
                            width: 50%;
                            height:50%;
                            top: 30%;
                            left: 25%;
                        }
                        .mouth {
                            position: absolute;
                            top: 60%;
                            left: 20%;
                            width: 80%;
                            height: 20%;
                            border-radius: 50%;
                            border-bottom: 8px solid black;
                        }
                        .mouth_circle {
                            position: relative;
                            top: 75%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            height: 90px;
                            width:80%;
                            border-radius: 0 0 200px 200px;
                            border-bottom: 8px solid black;
                            border-left: 8px solid black;
                            border-right: 8px solid black;
                        }
                        .mouth_left {
                            position: absolute;
                            top: 53%;
                            right: 5%;
                            width: 15%;
                            height: 1px;
                            border-radius: 25px;
                            border: 8px solid black;
                            rotate: -15deg;
                        }
                        .mouth_right {
                            position: absolute;
                            top: 53%;
                            left: 5%;
                            width: 15%;
                            height: 1px;
                            border-radius: 25px;
                            border: 8px solid black;
                            rotate: 15deg;
                        }
                    </style>
                    <title>Tipo smart</title>
                </head>

                <body>
                    <center>
                        <div class="smil_bg">
                            <div class="smiley">
                                <div class="smiley-face">
                                    {{-- <div class="style_font_1"></div>
                                    <div class="style_font_2"></div>
                                    <div class="rate_me">
                                        <h1 class="font-style">قــيــمـنى</h1>
                                    </div> --}}
                                    <div class="img">
                                        ${document.getElementById(companyId).innerHTML}
                                    </div>
                                    {{-- <div class="mouth_left"></div>
                                    <div class="mouth_right"></div>
                                    <div class="mouth_circle"></div> --}}
                                </div>
                            </div>
                        </div>
                    </center>
                </body>

            </html>`

        );

        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();
    }
</script>
