<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use App\Models\Employee;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    // all leaves
    public function index()
    {
        $all_leaves = Leave::with('userinfo')->orderBy('id','DESC')->get();
        $users = User::all();
        return view('portal_pages.leaves.leaves', compact('all_leaves','users'));
    }

    // add new leave
    public function addLeave(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $addLeave = new Leave;
            $addLeave->leave_type = $data['leave_type'];
            $addLeave->start_date = $data['start_date'];
            $addLeave->end_date = $data['end_date'];
            $addLeave->reason = $data['reason'];
            $addLeave->user_id = $data['user_id'];
            $addLeave->status = $data['status'] ?? "Pending";
            $addLeave->save();
            return redirect('/leaves')->with('success', 'Leave has been Submited');
        }
    }

    //approve leave
    public function approveLeave($id, Request $request)
    {
        Leave::where('id', $id)->update(['status' => 'Approved']);
        return redirect()->back()->with('success', 'Leave has been Approved');
    }

    //reject leave
    public function rejectLeave($id)
    {
        Leave::where('id', $id)->update(['status' => 'Rejected']);
        return redirect()->back()->with('success', 'Leave has been Rejected');
    }

    public function deleteLeave(Request $request)
    {
        Leave::where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Leave has been Deleted');
    }


}
