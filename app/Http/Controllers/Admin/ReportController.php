<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;

class ReportController extends Controller
{
    public function index()
    {
        $studentCount = User::role('student')->count();
        $courseCount = Course::count();
        $pendingAssignments = Assignment::where('status', 'pending')->count();

        return view('admin.reports.index', compact('studentCount', 'courseCount', 'pendingAssignments'));
    }
}
