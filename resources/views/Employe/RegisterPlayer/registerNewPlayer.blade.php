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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Register Player</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('employe.index') }}">Dashboard/Employe/
                                        Register Player</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">

                            {{--  message section  --}}
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

                            {{--  end message section  --}}

                            <form action="{{ route('employe.register.new.player.store') }}" method="post">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Choose Player:</label>
                                                <select class="form-control" id="inlineFormCustomSelect" name="player_id">
                                                    @foreach ($players as $player)
                                                    <option value="{{$player->id}}">{{$player->id}} - {{$player->first_name}}</option>  
                                                    @endforeach
                                                
                                                </select>
                                            </div>
                                        </div> 

                                        <div class="col-md-5">
                                            <div class="form-group mb-5">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Choose Courses:</label>
                                                <select class="form-control" id="inlineFormCustomSelect" name="course_id">
                                                    @foreach ($courses as $course)
                                                    <option value="{{$course->id}}">{{$course->id}}  -  {{$course->class->name}}  -  {{$course->trainer->first_name}}  -  {{$courseCounts[$course->id]}}/{{$course->capacity}} </option>  
                                                    @endforeach                                             
                                                </select>
                                            </div>
                                        </div> 

                                       
                                    </div>
                                    <div class="row">

                                        <div class="col-md-5">
                                            <div class="form-group mb-5">
                                                <label class="mr-sm-2" for="start_date">Start Date for Course:</label>
                                                <input class="form-control" id="start_date" type="date" name="start_date">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-5">
                                            <div class="form-group mb-5">
                                                <label class="mr-sm-2" for="duration">Duration Register:</label>
                                                <select class="form-control" id="duration" name="duration">
                                                    @for ($months = 1; $months <= 36; $months++)
                                                        <option value="{{ $months }}">{{ $months }} {{ $months === 1 ? 'month' : 'months' }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-5">
                                            <div class="form-group mb-5">
                                                <label class="mr-sm-2" for="end_date">End Date for Registration:</label>
                                                <input class="form-control" id="end_date" type="date" name="end_date" readonly>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#start_date, #duration').on('change', function () {
            var startDate = new Date($('#start_date').val());
            var durationMonths = parseInt($('#duration').val());
            if (!isNaN(startDate.getTime()) && !isNaN(durationMonths)) {
                var endDate = new Date(startDate);
                endDate.setMonth(endDate.getMonth() + durationMonths);
                $('#end_date').val(endDate.toISOString().slice(0, 10));
            }
        });
    });
</script>

