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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Admin Roles</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard/Admin/Admin
                                        Roles</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <div class="card">

                        {{-- message section --}}

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
                        {{-- end message section  --}}

                        <div class="card-body">


                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Admin Name:</label>
                                            <input type="text" class="form-control" id="nametext"
                                                aria-describedby="name" name="Name" value="{{ $admin->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Admin Email:</label>
                                            <input type="text" class="form-control" aria-describedby="email"
                                                name="email" value="{{ $admin->email }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">


                                    <form action="{{ route('admin.admin.roles', $admin->id) }}" method="POST">
                                        @csrf
                                        <div class="col-md-10">
                                            <div class="form-group mb-5">
                                                <label class="form-label">Role:</label>

                                                <select class="custom-select mr-sm-3" id="inlineFormCustomSelect"
                                                    name="role">
                                                    @foreach ($roles as $role)
                                                        <option selected>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-rounded  btn-info ">Assign</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-10">
                                        <div class="col-md-4 col-sm-4 p-4">
                                            <h4 class="card-title">Role:</h4>
                                            <div class="list-group">
                                                @if ($admin->roles)
                                                    @foreach ($admin->roles as $admin_roles)
                                                        <form method="post"
                                                            action="{{ route('admin.admin.roles.remove', [$admin->id, $admin_roles->id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                class="list-group-item list-group-item-action btn-danger">
                                                                {{ $admin_roles->name }}
                                                            </button>
                                                        </form>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
