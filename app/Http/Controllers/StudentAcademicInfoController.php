<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentAcademicInfo;
use Illuminate\Http\Request;

class StudentAcademicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentAcademicInfos = StudentAcademicInfo::all();
        return response()->json($studentAcademicInfos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('student_academic_info.create');
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
     * @param  \App\Models\StudentAcademicInfo  $studentAcademicInfo
     * @return \Illuminate\Http\Response
     */
    public function show(StudentAcademicInfo $studentAcademicInfo)
    {
        return response()->json($studentAcademicInfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAcademicInfo  $studentAcademicInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentAcademicInfo $studentAcademicInfo)
    {
        return response()->view('student_academic_info.edit', compact('studentAcademicInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentAcademicInfo  $studentAcademicInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAcademicInfo $studentAcademicInfo)
    {
        // Add your logic to update the resource here

        return response()->json(['message' => 'Resource updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAcademicInfo  $studentAcademicInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAcademicInfo $studentAcademicInfo)
    {
        // Add your logic to delete the resource here

        return response()->json(['message' => 'Resource deleted successfully'], 200);
    }
}
