<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentParentInfo;
use Illuminate\Http\Request;

class StudentParentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('student_parent_info.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('student_parent_info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add your logic to store the resource here

        return response()->json(['message' => 'Resource created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentParentInfo  $studentParentInfo
     * @return \Illuminate\Http\Response
     */
    public function show(StudentParentInfo $studentParentInfo)
    {
        return response()->view('student_parent_info.show', compact('studentParentInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentParentInfo  $studentParentInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentParentInfo $studentParentInfo)
    {
        return response()->view('student_parent_info.edit', compact('studentParentInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentParentInfo  $studentParentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentParentInfo $studentParentInfo)
    {
        // Add your logic to update the resource here

        return response()->json(['message' => 'Resource updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentParentInfo  $studentParentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentParentInfo $studentParentInfo)
    {
        // Add your logic to delete the resource here

        return response()->json(['message' => 'Resource deleted successfully'], 200);
    }
}
