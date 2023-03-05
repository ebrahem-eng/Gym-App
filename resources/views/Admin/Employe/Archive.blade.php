@extends('Admin.empty')
@include('layouts.adminHeader')

<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    <div class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Employe Archive</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}">Dashboard/Employe/Employe Archive</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <!-- =======  message restore  -->

        <div class="container-fluid">
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

            <!-- message force delete -->

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

            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-info text-white">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Salary</th>
                            <th>Work Time Start</th>
                            <th>Work Time End </th>
                            <th>Created at</th>
                            <th>Deleted at</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody class="border border-info">
                        @foreach ($trashed_employes as $trashed_employe)
                            <tr>
                                <td>{{ $trashed_employe->id }}</td>
                                <td>{{ $trashed_employe->first_name }}</td>
                                <td>{{ $trashed_employe->last_name }}</td>
                                <td>{{ $trashed_employe->email }}</td>
                                <td>{{ $trashed_employe->age }}</td>
                                <td>{{ $trashed_employe->phone }}</td>
                                <td>{{ $trashed_employe->salary }}</td>
                                <td>{{ $trashed_employe->work_time_start }}</td>
                                <td>{{ $trashed_employe->work_time_end }}</td>
                                <td>{{ $trashed_employe->created_at }}</td>
                                <td>{{ $trashed_employe->deleted_at }}</td>
                                <td>
                                    <a type="button" class="btn btn-circle btn-success mt-2 mr-2"
                                        href="{{ route('admin.employe.restore', $trashed_employe->id) }}"><i
                                            data-feather="refresh-ccw" class="feather-icon"></i></a>
                                    <a type="button" class="btn btn-circle btn-danger mt-2"
                                        href="{{ route('admin.employe.forcedelete', $trashed_employe->id) }}"><i
                                            data-feather="x" class="feather-icon"></i></a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
