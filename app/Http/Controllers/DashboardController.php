<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\employee_stat;

use App\Models\Leave;
use App\Models\Post;


class DashboardController extends Controller
{
    public function index()
    {

    }

    //getCheckin TIme
    public function getAttendanceTime()
    {
        $attendance = Attendance::where('user_id', auth()->user()->id)->limit(3)->get();
        $all_attendance= Attendance::where('user_id', auth()->user()->id)->latest()->paginate(10);
        $all_leaves = Leave::where('user_id', auth()->user()->id)->latest()->paginate(10);
        $all_posts = Post::latest()->paginate(10);

        $empstats = employee_stat::where('user_id',auth()->user()->id)->first();

        return view('portal_pages.dashboard', compact('attendance','all_attendance','all_leaves','empstats','all_posts'));

    }
}
