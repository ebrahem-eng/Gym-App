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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Employe Roles</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}">Dashboard/Employe/Employe Roles</a>
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


                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Employe Name:</label>
                                            <input type="text" class="form-control" id="nametext"
                                                aria-describedby="name" placeholder="Name" name="Name"
                                                value="{{ $employe->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Employe Email:</label>
                                            <input type="text" class="form-control" id="nametext"
                                                aria-describedby="name" placeholder="Name" name="email"
                                                value="{{ $employe->email }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">


                                    <form action="{{ route('admin.employe.roles', $employe->id) }}" method="POST">
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
                                            <div class="text-left">
                                                <button type="submit"
                                                    class="btn btn-rounded  btn-info ">Assign</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-6">
                                        <div class="col-md-4 col-sm-4 p-4">
                                            <h4 class="card-title">Role</h4>
                                            <div class="list-group"> <a href="javascript:void(0)"
                                                    class="list-group-item active">{{ $employe->name }}</a>
                                                @if ($employe->roles)
                                                    @foreach ($employe->roles as $employe_roles)
                                                        <form method="post"
                                                            action="{{ route('admin.users.roles.remove', [$employe->id, $employe_roles->id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="list-group-item">
                                                                {{ $employe_roles->name }}
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
</div>
