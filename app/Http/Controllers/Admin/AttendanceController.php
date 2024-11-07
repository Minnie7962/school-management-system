<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        return view('admin.attendance.index', compact('attendances'));
    }

    public function create()
    {
        return view('admin.attendance.create');
    }

    public function store(Request $request)
    {
        $attendance = new Attendance();
        // Populate the attendance model with form data
        $attendance->save();
        return redirect()->route('admin.attendance.index');
    }
}
