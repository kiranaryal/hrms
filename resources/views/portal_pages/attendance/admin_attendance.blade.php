@extends('portal_pages.layouts.master')
@section('title', 'All Admin Attendance')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
            </div>
        </div>


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
</div>

@endsection
