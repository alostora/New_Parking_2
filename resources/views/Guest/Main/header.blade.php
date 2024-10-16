<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @lang('general.app_name')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="{{ url('AdminDesign') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="{{ url('AdminDesign') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->


    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ url('AdminDesign') }}/lte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ url('AdminDesign') }}/lte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ url('AdminDesign') }}/lte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    {{-- <link rel="stylesheet" href="{{ url('AdminDesign') }}/myStyle.css"> --}}
    {{--

<link rel="stylesheet" href="{{url('AdminDesign')}}/bootstrap-print.css" media="print">
    --}}

    @if (App::getLocale() == 'ar' || App::getLocale() == '')
        <link rel="stylesheet" href="{{ url('AdminDesign') }}/bootstrap/css/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="{{ url('AdminDesign') }}/dist/css1/AdminLTE-rtl.min.css">
        <link rel="stylesheet" href="{{ url('AdminDesign') }}/dist/css1/skins/_all-skins-rtl.min.css">
        <?php $dir = 'rtl'; ?>
    @elseif(App::getLocale() == 'en')
        <?php $dir = 'ltr'; ?>
    @else
        <?php $dir = 'rtl'; ?>
    @endif

    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>


    <script src="{{ url('AdminDesign/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('AdminDesign/bower_components/jquery/dist/jquery.min.js') }}"></script>


    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <link href="{{ url('AdminDesign') }}/select2/select2.css" rel="stylesheet" />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->

    <script src="{{ url('AdminDesign') }}/select2/select2.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini" dir={{ $dir }}>


    @if ($errors->any())
        <div class="alert alert-warning col-md-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success col-md-6">
            <ul>
                <li>{{ session('success') }}</li>
            </ul>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-success col-md-6">
            <ul>
                <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif
