@extends('portal_pages.layouts.master')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="page-title">Leaves</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
              <li class="breadcrumb-item active">Leaves</li>
            </ul>
          </div>
          <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
          </div>
        </div>
      </div>
      {{-- <div class="row">
        <div class="col-md-3">
          <div class="stats-info">
            <h6>Today Presents</h6>
            <h4>12 / 60</h4>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stats-info">
            <h6>Planned Leaves</h6>
            <h4>8 <span>Today</span></h4>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stats-info">
            <h6>Unplanned Leaves</h6>
            <h4>0 <span>Today</span></h4>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stats-info">
            <h6>Pending Requests</h6>
            <h4>12</h4>
          </div>
        </div>
      </div> --}}
      {{-- <div class="row filter-row">
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
          <div class="form-group form-focus">
            <input type="text" class="form-control floating">
            <label class="focus-label">Employee Name</label>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
          <div class="form-group form-focus select-focus">
            <select class="select floating">
              <option> -- Select -- </option>
              <option>Casual Leave</option>
              <option>Medical Leave</option>
              <option>Loss of Pay</option>
            </select>
            <label class="focus-label">Leave Type</label>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
          <div class="form-group form-focus select-focus">
            <select class="select floating">
              <option> -- Select -- </option>
              <option> Pending </option>
              <option> Approved </option>
              <option> Rejected </option>
            </select>
            <label class="focus-label">Leave Status</label>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
          <div class="form-group form-focus">
            <div class="cal-icon">
              <input class="form-control floating datetimepicker" type="text">
            </div>
            <label class="focus-label">From</label>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
          <div class="form-group form-focus">
            <div class="cal-icon">
              <input class="form-control floating datetimepicker" type="text">
            </div>
            <label class="focus-label">To</label>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
          <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
              <thead>
                <tr>
                  <th>Employee</th>
                  <th>Leave Type</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Reason</th>
                  <th class="text-center">Status</th>
                  <th class="text-right">Actions</th>
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
                  <td class="text-center">
                    <div class="dropdown action-label">
                      <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-dot-circle-o text-success"></i> {{$all_lvs->status}}
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-purple"></i> New</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
                        <a class="dropdown-item" href="{{ url('approve-leave',$all_lvs->id)}}"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
                        <a class="dropdown-item" href="{{ url('reject-leave',$all_lvs->id)}}"><i class="fa fa-dot-circle-o text-danger"></i> Rejected</a>
                        </div>
                    </div>
                  </td>
                  <td class="text-right">
                        <form method="POST" class="dropdown-item" action="{{ route('delete-leave')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$all_lvs->id}}">
                            <button>delete</button>

                        </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <div id="add_leave"  class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Leave</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ url('add-leave')}}">
                @csrf
                <div class="form-group">
                    <label>User <span class="text-danger">*</span></label>

                        <select  class="select" name="user_id">
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>

                  </div>
              <div class="form-group">
                <label>Leave Type <span class="text-danger">*</span></label>
                <select class="select" name="leave_type">
                  <option>Select Leave Type</option>
                  <option>Casual Leave </option>
                  <option>Medical Leave</option>
                  <option>Loss of Pay</option>
                </select>
              </div>
              <div class="form-group">
                <label>From <span class="text-danger">*</span></label>
                <div class="cal-icon">
                  <input  type="date" name="start_date">
                </div>
              </div>
              <div class="form-group">
                <label>To <span class="text-danger">*</span></label>
                <div class="cal-icon">
                  <input  type="date" name="end_date">
                </div>
              </div>

              <div class="form-group">
                <label>Leave Reason <span class="text-danger">*</span></label>
                <textarea rows="4" class="form-control" name="reason"></textarea>
              </div>
              <div class="form-group">
                <label>Status <span class="text-danger">*</span></label>
                <select class="select" name="status">
                  <option>Pending</option>
                  <option>Approved</option>
                  <option>Rejected</option>
                </select>
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


@endsection
