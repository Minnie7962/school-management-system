<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\CourseInterface;
use App\Http\Requests\CourseStoreRequest;
use App\Interfaces\SchoolSessionInterface;
use App\Repositories\PromotionRepository;

class CourseController extends Controller
{
    use SchoolSession;
    protected $schoolCourseRepository;
    protected $schoolSessionRepository;

    /**
    * Create a new Controller instance
    * 
    * @param CourseInterface $schoolCourseRepository
    * @return void
    */
    public function __construct(SchoolSessionInterface $schoolSessionRepository, CourseInterface $schoolCourseRepository) {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolCourseRepository = $schoolCourseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $courses = $this->schoolCourseRepository->getAll($current_school_session_id);
        return response()->view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CourseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        try {
            $this->schoolCourseRepository->create($request->validated());

            return response()->json(['status' => 'Course creation was successful!']);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentCourses($student_id) {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotionRepository = new PromotionRepository();
        $class_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $student_id);
        $courses = $this->schoolCourseRepository->getByClassId($class_info->class_id);

        $data = [
            'class_info'    => $class_info,
            'courses'       => $courses,
        ];
        return response()->view('courses.student', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $course_id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $course = $this->schoolCourseRepository->findById($course_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'course'                    => $course,
            'course_id'                 => $course_id,
        ];

        return response()->view('courses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $this->schoolCourseRepository->update($request);

            return response()->json(['status' => 'Course update was successful!']);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            $this->schoolCourseRepository->delete($course->id);
            return response()->json(['status' => 'Course deletion was successful!']);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
