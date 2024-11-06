<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Models\Mark;
use App\Models\Notice;
use App\Models\Bus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalStudents' => Student::count(),
            'totalTeachers' => Teacher::count(),
            'totalBuses' => Bus::count(),
            'notices' => Notice::latest()->take(5)->get(),
            'studentsByClass' => Student::select('class', DB::raw('count(*) as count'))
                                      ->groupBy('class')
                                      ->get(),
            'recentStudents' => Student::with('user')
                                      ->latest()
                                      ->take(5)
                                      ->get(),
            'recentTeachers' => Teacher::with('user')
                                      ->latest()
                                      ->take(5)
                                      ->get(),
        ];

        return view('admin.dashboard.index', $data);
    }

    /**
     * @method \Illuminate\Contracts\Auth\Authenticatable|null user()
     */
    public function profile()
    {
        $user = auth()-> Grud::user();
        return view('admin.dashboard.profile', compact('user'));
    }

    public function settings()
    {
        return view('admin.settings.index');
    }
}
