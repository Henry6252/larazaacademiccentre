<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function index()
    {
        $studentId = auth()->id();

        $grades = DB::table('student_grades')
            ->where('student_id', $studentId)
            ->get();

        return view('student.grades.index', compact('grades'));
    }
}
