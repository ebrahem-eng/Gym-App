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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Class</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard/Classes/Add
                                        Class</a>
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

                            <form action="{{ route('admin.class.store') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Name:</label>
                                                <input type="text" class="form-control" id="nametext"
                                                    aria-describedby="name" placeholder="Name" name="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Class Time Start:</label>
                                                <input type="time" class="form-control"
                                                    placeholder="Class Time Start" name="ClassTimeStart">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Class Time End:</label>
                                                <input type="time" class="form-control" placeholder="Class Time End"
                                                    name="ClassTimeEnd">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <label class="form-label">Day:</label>
                                    <div class="row">

                                        <div class="col-md-4">
                                            @foreach ($days as $day)
                                                <fieldset class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="{{ $day->name }}"
                                                            name="day[{{ $day->name }}]"> {{ $day->name }}
                                                    </label>
                                                </fieldset>
                                            @endforeach
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
