<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        // Example dummy stats
        $stats = [
            'total_courses' => 6,
            'completed' => 4,
            'gpa' => 3.72,
            'pending_assignments' => 2,
        ];

        return view('student.dashboard.index', compact('student', 'stats'));
    }
}
