@extends('portal_pages.layouts.master')
@section('content')
  <div class="page-wrapper">
    <div class="content container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Employee Details</li>
            </ul>
          </div>
        </div>
      </div>


      <div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update {{$employee_stat->fname}} {{$employee_stat->lname}}'s information</h4>
            <form method="post" id="brandForm" name="brandForm" action="/update/employee_stat" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                   <input type="hidden" name="id" value="{{ $employee_stat->id}}">
                    <input type="hidden" name="user_id" value="{{$employee_stat->user_id}}">

                    <div class="row mb-3">
                        <div class="col">Ranking:
                            <input type="number" name="ranking"  value="{{ $employee_stat->ranking}}" placeholder="ranking" class="form-control" >
                        </div>
                        <div class="col">Role:
                            <input type="number" name="role"  value="{{ $employee_stat->role}}" placeholder="role" class="form-control" >
                        </div>
                        <div class="col">Experience:
                            <input type="number" name="experience"  value="{{ $employee_stat->experience}}" placeholder="experience" class="form-control" >
                        </div><div class="col">Salary:
                            <input type="number" name="salary"  value="{{ $employee_stat->salary}}" placeholder="salary" class="form-control" >
                        </div>
                    </div>


                        </div>
                        <div class="col">
                        <button type="submit" class="btn btn-md btn-success">Update</button>
                        </div>
                    </div>


                </div>

            </form>
                </div>
            </div>
        </div>
      </div>

  </div>

@endsection
