<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check.role:admin']);
    }

    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->save();
        return redirect()->route('admin.index');
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        return view('admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->save();
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->route('admin.index');
    }
    
    public function searchFunction()
    {
        return view('admin.search-function');
    }

    public function verifyRoleRedirect(Request $request)
    {
        if ($request->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($request->user()->hasRole('owner')) {
            return redirect()->route('owner.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function attendance()
    {
        return view('admin.attendance');
    }

    public function students()
    {
        return view('admin.students');
    }

    public function teachers()
    {
        return view('admin.teachers');
    }

    public function subjects()
    {
        return view('admin.subjects');
    }

    public function marks()
    {
        return view('admin.marks');
    }

    public function notes()
    {
        return view('admin.notes');
    }

    public function noticeboard()
    {
        return view('admin.noticeboard');
    }

    public function timetable()
    {
        return view('admin.timetable');
    }

    public function syllabus()
    {
        return view('admin.syllabus');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
