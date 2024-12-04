<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        
        return view('admin.dashboard', compact('studentCount', 'teacherCount'));
    }

    public function manageStudents()
    {
        $students = Student::with('user')->paginate(10);
        return view('admin.students', compact('students'));
    }

    public function uploadSyllabus(Request $request)
    {
        $path = $request->file('syllabus')->store('syllabusUploads', 'public');
        // Save path to database
    }
}
