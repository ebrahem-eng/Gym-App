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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Assign Permission</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard/Roles/Assign
                                        Permission</a>
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
                        <div class="card-body">

                            <form action="{{ route('admin.roles.permissions', $role->id) }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Role Name:</label>
                                                <input type="text" class="form-control" id="nametext"
                                                    aria-describedby="name" placeholder="Name" name="Name"
                                                    value="{{ $role->name }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <label class="form-label">Permissions:</label>

                                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect"
                                                    name="permission">
                                                    @foreach ($permissions as $permission)
                                                        <option selected>{{ $permission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-actions">
                                                <div class="text-left">
                                                    <button type="submit"
                                                        class="btn btn-rounded  btn-info ">Assign</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 p-4">
                                    <h4 class="card-title">Role Permission</h4>
                                    <div class="list-group"> <a href="javascript:void(0)"
                                            class="list-group-item active">{{ $role->name }}</a>

                                        @if ($role->permissions)
                                            @foreach ($role->permissions as $role_permission)
                                                <form method="POST"
                                                    action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}">
                                                    @method('Delete')
                                                    @csrf

                                                    <button class="list-group-item">
                                                        {{ $role_permission->name }}</button>

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

