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
    <title>
    </title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets2/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>


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
                            <li class="sidebar-item"><a href="{{ route('admin.employe.create') }}"
                                    class="sidebar-link"><span class="hide-menu"> Reset Password
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

                            <li class="sidebar-item"><a href="{{ route('admin.trainer.create') }}"
                                    class="sidebar-link"><span class="hide-menu"> Reset Password
                                    </span></a>
                            </li>

                            <li class="sidebar-item"><a href="{{ route('admin.trainer.archive') }}"
                                    class="sidebar-link"><span class="hide-menu">Trainer Archive

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

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="clock" class="feather-icon"></i><span
                                class="hide-menu">Manage Course</span></a>

                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="#" class="sidebar-link"><span class="hide-menu">
                                        Course List
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="#" class="sidebar-link"><span class="hide-menu">
                                        Add Course
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="#" class="sidebar-link"><span
                                        class="hide-menu">Course Archive

                                    </span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="user-plus" class="feather-icon"></i><span
                                class="hide-menu">Manage Admin</span></a>

                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ route('admin.admin.index') }}"
                                    class="sidebar-link"><span class="hide-menu">
                                        Admin List
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="#" class="sidebar-link"><span class="hide-menu">
                                        Add Admin
                                    </span></a>
                            </li>

                            <li class="sidebar-item"><a href="#" class="sidebar-link"><span class="hide-menu">
                                        Reset Password
                                    </span></a>
                            </li>

                            <li class="sidebar-item"><a href="#" class="sidebar-link"><span
                                        class="hide-menu">Admin Archive

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



                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="#"
                            aria-expanded="false"><i data-feather="eye" class="feather-icon"></i><span
                                class="hide-menu">Logging
                            </span></a>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="{{ route('admin.report.index') }}" aria-expanded="false"><i
                                data-feather="alert-circle" class="feather-icon"></i><span class="hide-menu">Reports
                            </span></a>
                    </li>

                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                    <form method="POST" action="{{ route('admin.logout') }}">
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
    <script src="{{ asset('assets2/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    <script src="{{ asset('assets2/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('assets2/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets2/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets2/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>

</body>

</html>
