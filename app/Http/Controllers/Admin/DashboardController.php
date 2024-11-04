<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\View\View;
use App\Models\Notice;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = [
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'total_subjects' => Subject::count(),
            'recent_students' => Student::with('user')->latest()->take(5)->get(),
            'recent_teachers' => Teacher::with('user')->latest()->take(5)->get(),
            'recent_notices' => Notice::latest()->take(5)->get(),
            'today_attendance' => Attendance::whereDate('date', Carbon::today())
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->get()
                ->pluck('count', 'status')
                ->toArray(),
        ];

        return view('admin.dashboard.index', $data);
    }
}
