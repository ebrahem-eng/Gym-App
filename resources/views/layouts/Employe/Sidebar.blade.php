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
    <link href="{{ asset('assets2/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
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
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('employe.index') }}"
                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"></span></li>

                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="{{ route('employe.check.player.status') }}" aria-expanded="false"><i
                                data-feather="user-check" class="feather-icon"></i><span class="hide-menu">Check Player
                                Status
                            </span></a>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span
                                class="hide-menu"> Manage Offers</span></a>

                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{route('employe.offer.index')}}" class="sidebar-link"><span class="hide-menu">
                                        Show Offers
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{route('employe.offer.create')}}" class="sidebar-link"><span class="hide-menu"> 
                                        Add Offer
                                    </span></a>
                            </li>

                            <li class="sidebar-item"><a href="{{route('employe.offer.archive')}}" class="sidebar-link"><span class="hide-menu">
                                        Offers Archive
                                    </span></a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="clock" class="feather-icon"></i><span
                                class="hide-menu">Manage </span></a>

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





                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                    <form method="POST" action="{{ route('employe.logout') }}">
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

    <script src="{{ asset('assets2/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
</body>

</html>
