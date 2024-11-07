<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }

    public function create() 
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // ... other validation rules
        ]);

        // Create a new student
        Student::create($validatedData);

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully!');
    }
}
