<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">
                <a href="{{ url('admin') }}">@lang('sidebar.home')</a>
            </li>
            <li class="active treeview">

                <a href="#">
                    <i class="fa fa-th-large"></i> <span>@lang('sidebar.dashboard')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu level-two">

                    <!-- countries -->
                    <li>
                        <a href="{{ url('admin/countries') }}">
                            <i class="ion ion-earth"></i>@lang('sidebar.countries')
                        </a>
                    </li>

                    <!-- governorates -->
                    <li>
                        <a href="{{ url('admin/governorates-search-all') }}">
                            <i class="fa fa-map"></i>@lang('sidebar.governorates')
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('admin/users') }}">
                            <i class="fa fa-users"></i> @lang('sidebar.admins')
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('admin/clients/search?active=active') }}">
                            <i class="ion ion-ios-people"></i> @lang('sidebar.edit_client')
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
</aside>
















{{--


<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('AdminDesign') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><a href="{{ url('admin') }}">@lang('sidebar.home')</a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>@lang('sidebar.dashboard')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ url('admin/countries') }}">
                            <i class="ion ion-earth"></i>@lang('sidebar.countries')
                        </a>
                    </li>

                    <!-- governorates -->
                    <li>
                        <a href="{{ url('admin/governorates-search-all') }}">
                            <i class="fa fa-map"></i>@lang('sidebar.governorates')
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Layout Options</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                    <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                    <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                    <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a>
                    </li>
                </ul>
            </li>


            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>










 --}}









<div class="content-wrapper">

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
