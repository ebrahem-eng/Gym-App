@extends('Admin.empty')

<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    @include('layouts.adminHeader')

    <div class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Admin Archive</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}">Dashboard/Admin/Admin Archive</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <!-- =======  message restore  -->

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card-body">


                        {{-- message section --}}

                        @if (session('message_success_restore'))
                            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('message_success_restore') }}
                            </div>
                        @endif
                        @if (session('message_err_restore'))
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('message_err_restore') }}
                            </div>
                        @endif



                        @if (session('message_success_forcedelete'))
                            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('message_success_forcedelete') }}
                            </div>
                        @endif
                        @if (session('message_err_forcedelete'))
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('message_err_forcedelete') }}
                            </div>
                        @endif


                        {{-- end message section --}}

                        <div class="table-responsive">
                            @if (count($admins)>0)
                                <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                                    style="width:100%">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Salary</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Deleted Date</th>                                        
                                            <th></th>
                                        </tr>


                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $admin->id }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->age }}</td>
                                                <td>
                                                    @if($admin->gender == 0)
                                                    <div>
                                                       Female
                                                    </div>
                                                    @else
                                                    <div>
                                                       Male
                                                    </div>  
                                                    @endif
                                                   </td>
                                                <td>{{ $admin->phone }}</td>
                                                <td>{{ $admin->address }}</td>
                                                <td>{{ $admin->salary->value }}SYP</td>
                                                <td><img src="{{ asset('image/' . $admin->img) }}"
                                                    style="width: 100px; height: 100px;"></td>
                                               
                                                <td>
                                                    @if ($admin->status == 0)
                                                        <span class="btn btn-danger rounded-pill me-1">Not Active</span>
                                                    @elseif ($admin->status == 1)
                                                        <span class="btn btn-success rounded-pill me-1">Active</span>
                                                    @endif
                                                </td>
                                                <td>{{ $admin->created_at }}</td>
                                                <td>{{ $admin->deleted_at }}</td>
                                        
                                                <td>
                                                    <a type="button" class="btn btn-circle btn-success mt-2 mr-2"
                                                        href="{{ route('admin.admin.restore', $admin->id) }}"><i
                                                            data-feather="refresh-ccw" class="feather-icon"></i></a>
                                                    <a type="button" class="btn btn-circle btn-danger mt-2"
                                                        href="{{ route('admin.admin.forcedelete', $admin->id) }}"><i
                                                            data-feather="x" class="feather-icon"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <div style="text-align: center;" class="card">
                                            <h2
                                                style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif ; color:#5f76e8 ; margin-top:15px; margin-bottom:15px;">
                                                No Data</h2>
                                        </div>
                            @endif

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
