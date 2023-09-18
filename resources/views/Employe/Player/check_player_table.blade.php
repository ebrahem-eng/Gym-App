@extends('layouts.Employe.Sidebar')
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    @include('layouts.Employe.Header')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Chaeck Player</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('employe.index') }}">Dashboard/Player/Player Table</a>
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
                            @if (count($players) > 0)
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Status</th>
                                            <th>Phone</th>
                                            <th>Level</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($players as $player)
                                            <tr>
                                                <td>{{ $player->id }}</td>
                                                <td>{{ $player->first_name }}</td>
                                                <td>{{ $player->last_name }}</td>
                                                <td>{{ $player->email }}</td>
                                                <td>{{ $player->age }}</td>
                                                <td>
                                                    @if ($player->status == 0)
                                                        <span class="btn btn-danger rounded-pill me-1">Not Active</span>
                                                    @elseif ($player->status == 1)
                                                        <span class="btn btn-success rounded-pill me-1">Active</span>
                                                    @endif
                                                </td>
                                                <td>{{ $player->phone }}</td>
                                                <td>{{ $player->level }}</td>

                                                <td>

                                                    <form method="get" action="{{route('employe.player.course.details' , $player->id)}}">
                                                       @csrf
                                                        <button type="submit" class="btn btn-dark rounded-lg">Show
                                                            Details</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            @else
                                <div style="text-align: center;" class="card">
                                    <h2
                                        style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif ; color:#5f76e8 ; margin-top:15px; margin-bottom:15px;">
                                        No Data</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
