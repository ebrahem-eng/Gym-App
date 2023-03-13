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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Trainer Manage</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}">Dashboard/Trainer/Trainer Table</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">
        
            <div class="row">
                <div class="col-12">
    
                    <div class="card-body">
    
    
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
                        {{-- end message section --}}
    
                        <div class="table-responsive">
    @if (count($trainers)>0)
        
    
                            <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                                style="width:100%">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Phone</th>
                                        <th>Class</th>
                                        <th>Salary</th>
                                        <th>Work Time Start</th>
                                        <th>Work Time End </th>
                                        <th>Created </th>
                                        <th>Updated </th>
                                        <th></th>       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trainers as $trainer)
                                    <tr>
                                        <td>{{ $trainer->id }}</td>
                                        <td>{{ $trainer->first_name }}</td>
                                        <td>{{ $trainer->last_name }}</td>
                                        <td>{{ $trainer->email }}</td>
                                        <td>{{ $trainer->age }}</td>
                                        <td>{{ $trainer->phone }}</td>
                                        <td>{{ $trainer->class }}</td>
                                        <td>{{ $trainer->salary }}</td>
                                        <td>{{ $trainer->work_time_start }}</td>
                                        <td>{{ $trainer->work_time_end }}</td>
                                        <td>{{ $trainer->created_at }}</td>
                                        <td>{{ $trainer->updated_at }}</td>
                                        <td><a type="button" class="btn btn-circle btn-primary mt-2 mr-2"
                                                href="{{ route('admin.trainer.edit', $trainer->id) }}"><i data-feather="edit-2"
                                                    class="feather-icon"></i></a>
                                            <button class="btn btn-circle btn-dark mt-2 mr-2 "><i data-feather="key"
                                                    class="feather-icon"></i> </button>
                                            <form method="POST" action="{{ route('admin.trainer.destroy', $trainer->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-circle btn-danger mt-2"><i
                                                        data-feather="x" class="feather-icon"></i></button>
                                            </form>
        
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
