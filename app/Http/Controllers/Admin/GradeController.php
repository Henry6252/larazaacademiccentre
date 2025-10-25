<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GradeController extends Controller
{
    public function index()
    {
        // All students and units summary
        $grades = DB::table('student_grades')->get();
        return view('admin.grades.index', compact('grades'));
    }

    public function student($studentId)
    {
        $student = User::findOrFail($studentId);

        $grades = DB::table('student_grades')
            ->where('student_id', $studentId)
            ->get();

        return view('admin.grades.student', compact('student', 'grades'));
    }
}
