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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Update Trainer</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}">Dashboard/Trainer/Update Trainer</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-11">
                    <div class="card">
                        <div class="card-body">
                            @if (session('message_success_update'))
                                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                                    role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ session('message_success_update') }}
                                </div>
                            @endif
                            @if (session('message_err_update'))
                                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                    role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ session('message_err_update') }}
                                </div>
                            @endif
                            <form action="{{ route('admin.trainer.update', $trainer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">First Name:</label>
                                                <input type="text" class="form-control" id="nametext"
                                                    aria-describedby="name" placeholder="First Name" name="firstName"
                                                    value="{{ $trainer->first_name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Last Name:</label>
                                                <input type="text" class="form-control" placeholder="Last Name"
                                                    name="lastName" value="{{ $trainer->last_name }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">Email:</label>
                                                <input type="email" class="form-control" placeholder="Email"
                                                    name="email" value="{{ $trainer->email }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">Phone:</label>
                                                <input type="tel" class="form-control" placeholder="Phone"
                                                    name="phone" value="{{ $trainer->phone }}" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Salary:</label>
                                                <input type="text" class="form-control" placeholder="Salary"
                                                    name="salary" value="{{ $trainer->salary }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Age:</label>
                                                <input type="number" class="form-control" placeholder="Age"
                                                    name="age" value="{{ $trainer->age }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label">Class:</label>


                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect"
                                                name="class">
                                                @foreach ($classes as $class)
                                                    <option selected value="{{ $trainer->class }}">
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>


                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Work Time Start:</label>
                                                <input type="time" class="form-control"
                                                    placeholder="Work Time Start" name="WorkTimeStart"
                                                    value="{{ $trainer->work_time_start }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Work Time End:</label>
                                                <input type="time" class="form-control"
                                                    placeholder="Work Time End" name="WorkTimeEnd"
                                                    value="{{ $trainer->work_time_end }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-rounded  btn-info">Submit</button>
                                        <button type="reset" class="btn btn-rounded  btn-dark">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
