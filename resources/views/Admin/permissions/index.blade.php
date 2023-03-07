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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Permission Manage</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.index') }}">Dashboard/Permissions/Permission Table</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-10">
    
                <div class="card-body">

                  {{-- message section --}}
        
                    {{-- end message section --}}
    
                    <div class="table-responsive">
    
                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a type="button" class="btn btn-circle btn-dark"
                                        href="{{ route('admin.go.permissions.roles', $permission->id) }}"><i
                                            data-feather="key" class="feather-icon"></i> </a>
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
