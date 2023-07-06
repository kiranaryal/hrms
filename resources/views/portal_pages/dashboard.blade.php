@php
// fetch checkin time in attendance box
use App\Models\Attendance;


$getAtt =  Attendance::where('id', session()->get('checkin_status'))->first();
if($getAtt){
    $prntAtt = $getAtt->checkin;
}
else{
    $prntAtt = "0";
}

@endphp

@extends('portal_pages.layouts.master')
@section('content')

@section('title', 'Dashboard')

    {{-- employee html --}}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img alt="" src="{{ asset('assets/img/profiles/avatar-02.jpg') }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, {{ Auth::user()->name }}</h3>
                            <p>{{ date('d F Y g:i:A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    @if (is_array(session('success')))
                        <ul>
                            @foreach (session('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session('success') }}
                    @endif
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="card punch-status">
                        <div class="card-body">
                            <h5 class="card-title">Timesheet <small class="text-muted">{{ date('d F Y') }}</small>
                            </h5>
                            <div class="punch-det">
                                <h6>Punch In at</h6>
                                <p>
                                   {{-- {{ $getAtTime->status}} --}}
                                </p>
                            </div>
                            <div class="punch-info">
                                <div class="punch-hours">
                                    <span> {{$prntAtt}}</span>
                                </div>
                            </div>
                            <div class="punch-btn-section">
                                {{-- <button type="button" class="btn btn-primary punch-btn">Punch Out</button> --}}

                                <form method="POST" action="{{ url('checkin') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    @if (Session::has('checkin_status'))
                                        <input type="submit" class="btn btn-primary punch-btn" value="Checkout">
                                    @else
                                        <input type="submit" class="btn btn-primary punch-btn" value="Checkin">
                                    @endif
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card recent-activity">
                        <div class="card-body">
                            <h5 class="card-title">Today Activity</h5>
                            <ul class="res-activity-list">
                                @foreach($attendance as $a)
                                @if($a->checkin!=0)
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        {{$a->checkin}}
                                    </p>
                                </li>
                                @endif
                                @if($a->checkout!=0)
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        {{$a->checkout}}
                                    </p>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card recent-activity">
                        <div class="card-body">
                            <h5 class="card-title">View Projected Salary</h5>
                            <p class="mb-0">After years of experience</p>
                            <input type="number" name="experience" id="experience">
                         <div id="msg"></div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row filter-row">
                <div class="col-sm-3">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input type="text" class="form-control floating datetimepicker">
                        </div>
                        <label class="focus-label">Date</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>-</option>
                            <option>Jan</option>
                            <option>Feb</option>
                            <option>Mar</option>
                            <option>Apr</option>
                            <option>May</option>
                            <option>Jun</option>
                            <option>Jul</option>
                            <option>Aug</option>
                            <option>Sep</option>
                            <option>Oct</option>
                            <option>Nov</option>
                            <option>Dec</option>
                        </select>
                        <label class="focus-label">Select Month</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>-</option>
                            <option>2019</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                        <label class="focus-label">Select Year</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div> --}}
            <h3>All Attendances</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date </th>
                                    <th>Employee</th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_attendance as $i=>$a)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{date('Y-m-d',strToTime($a->date))}}</td>
                                    <td>{{$a->user->name}}</td>
                                    <td>{{date('H-i',strToTime($a->checkin))}}</td>

                                    <td>{{date('H-i',strToTime($a->checkout))}}</td>
                                </tr>
                                @endforeach
                                {{ $all_attendance->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <h3>All Leaves</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                              <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason</th>
                                {{-- <th class="text-right">Actions</th> --}}
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_leaves as $all_lvs )
                              <tr>
                                  <td hidden class="id" name="id">{{ $all_lvs->id}}</td>
                                <td>
                                  <h2 class="table-avatar">
                                    {{ $all_lvs->userinfo->name }}
                                  </h2>
                                </td>
                                <td>{{ $all_lvs->leave_type}}</td>
                                <td class="start_date">{{ date('d F, Y', strtotime( $all_lvs->start_date))}}</td>
                                <td>{{ date('d F, Y', strtotime( $all_lvs->end_date))}}</td>
                                <td>{{$all_lvs->reason}}</td>
{{--
                                <td class="text-right">
                                      <form method="POST" class="dropdown-item" action="{{ route('delete-leave')}}">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$all_lvs->id}}">
                                          <button>delete</button>

                                      </form>
                                </td> --}}
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- <div class="col-lg-8 col-md-8">
                    <section class="dash-section">
                        <h1 class="dash-sec-title">Today</h1>
                        <div class="dash-sec-content">
                            <div class="dash-info-list">
                                <a href="#" class="dash-card text-danger">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-hourglass-o"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>Richard Miles is off sick today</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <div class="e-avatar"><img src="assets/img/profiles/avatar-09.jpg"
                                                    alt=""></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dash-info-list">
                                <a href="#" class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>You are away today</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg"
                                                    alt=""></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dash-info-list">
                                <a href="#" class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>You are working from home today</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg"
                                                    alt=""></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                    <section class="dash-section">
                        <h1 class="dash-sec-title">Tomorrow</h1>
                        <div class="dash-sec-content">
                            <div class="dash-info-list">
                                <div class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>2 people will be away tomorrow</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-04.jpg"
                                                    alt=""></a>
                                            <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-08.jpg"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="dash-section">
                        <h1 class="dash-sec-title">Next seven days</h1>
                        <div class="dash-sec-content">
                            <div class="dash-info-list">
                                <div class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>2 people are going to be away</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-05.jpg"
                                                    alt=""></a>
                                            <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-07.jpg"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-info-list">
                                <div class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-user-plus"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>Your first day is going to be on Thursday</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg"
                                                    alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-info-list">
                                <a href="" class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>It's Spring Bank Holiday on Monday</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </div> --}}
                {{-- <div class="col-lg- col-md-4">
                    <div class="dash-sidebar">
                        <section>
                            <h5 class="dash-title">Projects</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>71</h4>
                                            <p>Total Tasks</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>14</h4>
                                            <p>Pending Tasks</p>
                                        </div>
                                    </div>
                                    <div class="request-btn">
                                        <div class="dash-stats-list">
                                            <h4>2</h4>
                                            <p>Total Projects</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Your Leave</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>4.5</h4>
                                            <p>Leave Taken</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>12</h4>
                                            <p>Remaining</p>
                                        </div>
                                    </div>
                                    <div class="request-btn">
                                        <a class="btn btn-primary" href="#">Apply Leave</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Your time off allowance</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>5.0 Hours</h4>
                                            <p>Approved</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>15 Hours</h4>
                                            <p>Remaining</p>
                                        </div>
                                    </div>
                                    <div class="request-btn">
                                        <a class="btn btn-primary" href="#">Apply Time Off</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Upcoming Holiday</h5>
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="holiday-title mb-0">Mon 20 May 2019 - Ramzan</h4>
                                </div>
                            </div>
                        </section>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


@endsection

<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script>
    $(document).ready(function () {
    $('#experience').on('change',  function () {

    let experience = $('#experience').val();


      $.ajax({
         type:'GET',
         url:'/test/'+experience,
         success:function(data) {
            $('#msg').html("Salary="+data);
         }
      });
    });
});
</script>

