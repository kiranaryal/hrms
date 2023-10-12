@extends('portal_pages.layouts.master')
@section('content')
  <div class="page-wrapper">
    <div class="content container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Employee Details</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
            <div class="col-lg-12">
                <x-message />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <div>

                 <table class="table table-striped custom-table mb-0 datatable">
                   <thead>
                     <tr>
                       <th>Name</th>
                       <th>Ranking</th>
                       <th>Role</th>
                       <th>Experience</th>
                       <th>Salary</th>
                       <th>Year</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <tbody>
                     @foreach($employee_stat as $get)
                     <tr>
                       <td>{{ $get->fname}} {{ $get->lname}}</td>
                       <td>{{ $get->ranking}}</td>
                       <td>{{ $get->role}}</td>
                       <td>{{ $get->experience}}</td>
                       <td>{{ $get->salary}}</td>
                       <td>{{ $get->year}}</td>
                       <td>
                             <a  href="{{ route('employee_stats_edit', $get->id)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>

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

@endsection
