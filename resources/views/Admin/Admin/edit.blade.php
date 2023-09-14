@extends('layouts.adminSidebar')

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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Admin</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard/Admin/Edit
                                        Admin</a>
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
                    <div class="card">
                        <div class="card-body">

                            {{-- message section --}}

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

                            {{-- end message section --}}

                            <form action="{{ route('admin.admin.update', $admin->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Name:</label>
                                                <input type="text" class="form-control" id="nametext"
                                                    aria-describedby="name" placeholder="Name" value="{{$admin->name}}" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">Email:</label>
                                                <input type="email" class="form-control" placeholder="Email"
                                                    name="email" value="{{$admin->email}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">Phone:</label>
                                                <input type="tel" class="form-control" placeholder="Phone"
                                                    name="phone" value="{{$admin->phone}}" required>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Status:</label>
                                                <select class="form-control" id="inlineFormCustomSelect" name="status">
                                                   
                                                    <option value="1" {{ $admin->status === 1 ? 'selected' : '' }}>Active</option>  
                                                    <option value="0" {{ $admin->status === 0 ? 'selected' : '' }}>Not Active</option>
                                                    
                                                
                                                </select>
                                            </div>
                                        </div> 

                                    </div>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Age:</label>
                                                <input type="number" class="form-control" placeholder="Age"
                                                    name="age" value="{{$admin->age}}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Gender:</label>
                                                <select class="form-control" id="inlineFormCustomSelect" name="gender">
                                                   
                                                    <option value="1"  {{ $admin->gender === 1 ? 'selected' : '' }}>Male</option>  
                                                    <option value="0"  {{ $admin->gender === 0 ? 'selected' : '' }}>Female</option>
                                                    
                                                
                                                </select>
                                            </div>
                                        </div> 

                                    

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Address:</label>
                                                <input type="text" class="form-control" placeholder="Address"
                                                    name="address" value="{{$admin->address}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">


                                  

                                        <div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Salary(SYP):</label>
                                                <select class="form-control" id="inlineFormCustomSelect" name="salary">
                                                    @foreach ($salaries as $salary)
                                                    <option value="{{$salary->id}}" {{ $admin->salary_id === $salary->id ? 'selected' : '' }}>{{$salary->value}}</option>  
                                                    @endforeach
                                                
                                                </select>
                                            </div>
                                        </div> 

                                        <div class="col-md-5">
                                          
                                            <div class="input-group-prepend">
                                                <label class="form-label">Image:</label>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="img" >
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                    
                                    </div>

                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-rounded  btn-info">Update</button>
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
    {{-- </div> --}}
