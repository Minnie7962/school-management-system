<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check.role:teacher']);
    }

    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->save();
        return redirect()->route('teacher.index');
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        return view('teacher.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->save();
        return redirect()->route('teacher.index');
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect()->route('teacher.index');
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function attendance()
    {
        return view('teacher.attendance');
    }

    public function leaves()
    {
        return view('teacher.leaves');
    }

    public function marks()
    {
        return view('teacher.marks');
    }

    public function notes()
    {
        return view('teacher.notes');
    }

    public function timetable()
    {
        return view('teacher.timetable');
    }

    public function settings()
    {
        return view('teacher.settings');
    }
}
