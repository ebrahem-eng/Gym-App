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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Employe Manage</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}"><strong>Dashboard</strong>/Employe/Employe
                                        Table</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">
            @if (session('message_success'))
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                    role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('message_success') }}
                </div>
            @endif
            @if (session('message_err'))
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                    role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('message_err') }}
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
                            <th>Updated at</th>
                            <th></th>


                        </tr>

                    </thead>
                    <tbody class="border border-info">
                        @foreach ($employes as $employe)
                            <tr>
                                <td>{{ $employe->id }}</td>
                                <td>{{ $employe->first_name }}</td>
                                <td>{{ $employe->last_name }}</td>
                                <td>{{ $employe->email }}</td>
                                <td>{{ $employe->age }}</td>
                                <td>{{ $employe->phone }}</td>
                                <td>{{ $employe->salary }}</td>
                                <td>{{ $employe->work_time_start }}</td>
                                <td>{{ $employe->work_time_end }}</td>
                                <td>{{ $employe->created_at }}</td>
                                <td>{{ $employe->updated_at }}</td>
                                <td><a type="button" class="btn btn-circle btn-primary mt-2 mr-2 "
                                        href="{{ route('admin.employe.edit', $employe->id) }}"><i data-feather="edit-2"
                                            class="feather-icon"></i></a>
                                    <a type="button" class="btn btn-circle btn-dark mt-2 mr-2 " href="#"><i
                                            data-feather="key" class="feather-icon"></i> </a>
                                    <form method="post" action="{{ route('admin.employe.destroy', $employe->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-circle btn-danger mt-2" type="submit"><i
                                                data-feather="x" class="feather-icon"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
