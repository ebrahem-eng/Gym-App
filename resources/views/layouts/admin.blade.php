<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets2/images/features-first-icon.png') }}">
    <title> @section('title')
        @endsection
    </title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets2/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <!-- Sidebar navigation-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('admin.index') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu"></span></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                                    class="hide-menu"> Employe</span></a>

                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="{{ route('admin.employe.index') }}"
                                        class="sidebar-link"><span class="hide-menu"> Employe Table
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ route('admin.employe.create') }}"
                                        class="sidebar-link"><span class="hide-menu"> Add Employe
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ route('admin.employe.archive') }}"
                                        class="sidebar-link"><span class="hide-menu">Employe Archive

                                        </span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                    class="hide-menu"> Trainer</span></a>

                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="{{ route('admin.trainer.index') }}"
                                        class="sidebar-link"><span class="hide-menu"> Trainer Table
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ route('admin.trainer.create') }}"
                                        class="sidebar-link"><span class="hide-menu"> Add Trainer
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ route('admin.trainer.archive') }}"
                                        class="sidebar-link"><span class="hide-menu">Trainer Archive

                                        </span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="activity" class="feather-icon"></i><span
                                    class="hide-menu">Manage Exersice</span></a>

                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link"><span
                                            class="hide-menu"> Exersice List
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                                            class="hide-menu"> Add Exersice
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-checkbox-radio.html"
                                        class="sidebar-link"><span class="hide-menu">Exersice Archive

                                        </span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="clipboard" class="feather-icon"></i><span
                                    class="hide-menu">Manage Classes</span></a>

                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="{{ route('admin.class.index') }}"
                                        class="sidebar-link"><span class="hide-menu"> Classes List
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ route('admin.class.create') }}"
                                        class="sidebar-link"><span class="hide-menu"> Add Class
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ route('admin.class.archive') }}"
                                        class="sidebar-link"><span class="hide-menu">Class Archive

                                        </span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Authorization</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="{{ route('admin.roles.index') }}" aria-expanded="false"><i data-feather="key"
                                    class="feather-icon"></i><span class="hide-menu">Roles
                                </span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="{{ route('admin.permissions.index') }}" aria-expanded="false"><i
                                    data-feather="lock" class="feather-icon"></i><span class="hide-menu">Permissions
                                </span></a>
                        </li>




                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">COMPONENTS</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="bar-chart" class="feather-icon"></i><span
                                    class="hide-menu">Charts </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="chart-morris.html" class="sidebar-link"><span
                                            class="hide-menu"> Morris Chart
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="chart-chart-js.html" class="sidebar-link"><span
                                            class="hide-menu"> ChartJs
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="chart-knob.html" class="sidebar-link"><span
                                            class="hide-menu">
                                            Knob Chart
                                        </span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                aria-expanded="false"><i data-feather="clock" class="feather-icon"></i><span
                                    class="hide-menu">Manage Course
                                </span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="#" aria-expanded="false"><i
                                data-feather="eye" class="feather-icon"></i><span
                                class="hide-menu">Logging
                            </span></a>
                    </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="{{ route('admin.report.index') }}" aria-expanded="false"><i
                                    data-feather="alert-circle" class="feather-icon"></i><span
                                    class="hide-menu">Reports
                                </span></a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li class="sidebar-item">
                                <a class="sidebar-link sidebar-link" aria-expanded="false" type="button">
                                    <i data-feather="log-out" class="feather-icon">
                                    </i><span class="hide-menu"><button type="submit"
                                            style="background: transparent;  border: 0px solid;">Logout</button></span></a>
                            </li>
                        </form>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
                <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

        <!-- footer -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

</body>

</html>
