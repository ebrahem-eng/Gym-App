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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Class Manage</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.index') }}">Dashboard/Classes/Classess Archive</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

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
                                <th>Name</th>
                                <th>Day</th>
                                <th>Class Time Start</th>
                                <th>Class Time End </th>
                                <th>Created</th>
                                <th>Deleted</th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody class="border border-info">
                            @foreach ($class_deleted as $class_delete)
                                <tr>
                                    <td>{{ $class_delete->id }}</td>
                                    <td>{{ $class_delete->name }}</td>
                                    <td>{{ $class_delete->day }}</td>
                                    <td>{{ $class_delete->class_time_start }}</td>
                                    <td>{{ $class_delete->class_time_end }}</td>
                                    <td>{{ $class_delete->created_at }}</td>
                                    <td>{{ $class_delete->deleted_at }}</td>

                                    <td>
                                        <a type="button" class="btn btn-circle btn-success mt-2 mr-2 "
                                            href="{{ route('admin.class.restore', $class_delete->id) }}"><i
                                                data-feather="refresh-ccw" class="feather-icon"></i></a>
                                        <a type="button" class="btn btn-circle btn-danger mt-2"
                                            href="{{ route('admin.class.forcedelete', $class_delete->id) }}"><i
                                                data-feather="x" class="feather-icon"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
