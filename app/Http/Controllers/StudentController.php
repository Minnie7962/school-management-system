<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\FeeRecord;
use Illuminate\Support\Facades\Auth;

class StudentController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check.role:student']);
    }

    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->save();
        return redirect()->route('student.index');
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('student.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->save();
        return redirect()->route('student.index');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('student.index');
    }

    public function checkFeeReceipt()
    {
        $receipts = FeeRecord::where('student_id', Auth::id())->get();
        return view('student.fee-receipts', compact('receipts'));
    }

    public function fetchAttendance()
    {
        $attendance = Attendance::where('student_id', Auth::id())->get();
        return view('student.attendance', compact('attendance'));
    }

    public function fetchAttendancePercentage()
    {
        $percentage = Attendance::where('student_id', Auth::id())
                                ->avg('attendance_percentage');
        return view('student.attendance-percentage', ['percentage' => $percentage]);
    }

    public function fetchTimetable()
    {
        return view('student.timetable');
    }

    public function password()
    {
        return view('student.change-password');
    }

    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function feePayment()
    {
        return view('student.fee-payment');
    }

    public function progress()
    {
        return view('student.progress');
    }

    public function exam()
    {
        return view('student.exam');
    }

    public function timetable()
    {
        return view('student.timetable');
    }
}
