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
                <input type="hidden"  name="user_id" value="{{auth()->user()->id}}">
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

              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


@endsection
