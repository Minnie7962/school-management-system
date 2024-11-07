<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mark;

class MarksController extends Controller
{
    public function index()
    {
        $marks = Mark::all();
        return view('admin.marks.index', compact('marks'));
    }

    public function create()
    {
        return view('admin.marks.create');
    }

    public function store(Request $request)
    {
        $mark = new Mark();
        // Populate the mark model with form data
        $mark->save();
        return redirect()->route('admin.marks.index');
    }

    // Add other CRUD methods (show, edit, update, destroy) as needed
}
