<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Leave;


class DashboardController extends Controller
{
    public function index()
    {

        dd();
    }

    //getCheckin TIme
    public function getAttendanceTime()
    {
        $attendance = Attendance::where('user_id', auth()->user()->id)->limit(3)->get();
        $all_attendance= Attendance::where('user_id', auth()->user()->id)->latest()->paginate(10);
        $all_leaves = Leave::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return view('portal_pages.dashboard', compact('attendance','all_attendance','all_leaves'));

    }
}
