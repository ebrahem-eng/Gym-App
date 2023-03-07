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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Class Manage</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}">Dashboard/Classes/Classess Table</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        {{-- <div class="container-fluid"> --}}


        <div class="row">
            <div class="col-12">

                <div class="card-body">


                    {{-- message section --}}

                    @if (session('message_success_delete'))
                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                            role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('message_success_delete') }}
                        </div>
                    @endif
                    @if (session('message_err_delete'))
                        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                            role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('message_err_delete') }}
                        </div>
                    @endif

                    {{-- end message section --}}

                    <div class="table-responsive">

                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Day</th>
                                    <th>Class Time Start</th>
                                    <th>Class Time End </th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                    <tr>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->name }}</td>
                                        <td>{{ $class->day }}</td>
                                        <td>{{ $class->class_time_start }}</td>
                                        <td>{{ $class->class_time_end }}</td>
                                        <td>{{ $class->created_at }}</td>
                                        <td>{{ $class->updated_at }}</td>
                                        <td>
                                            <a type="button" class="btn btn-circle btn-primary "
                                                href="{{ route('admin.class.edit', $class->id) }}"><i
                                                    data-feather="edit-2" class="feather-icon"></i></a>
                                            <form action="{{ route('admin.class.destroy', $class->id) }}" ,
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-circle btn-danger mt-2"><i
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
        </div>
    </div>
