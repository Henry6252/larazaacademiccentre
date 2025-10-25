<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CourseUnit;

class GradeController extends Controller
{
    public function index()
    {
        // Get only units taught by this tutor
        $units = CourseUnit::whereHas('tutors', function($q){
            $q->where('tutor_id', auth()->id());
        })->get();

        return view('tutor.grades.index', compact('units'));
    }

    public function unit($courseUnitId)
    {
        $unit = CourseUnit::findOrFail($courseUnitId);

        $grades = DB::table('student_grades')
            ->where('tutor_id', auth()->id())
            ->where('course_unit_id', $courseUnitId)
            ->get();

        return view('tutor.grades.unit', compact('unit', 'grades'));
    }
}
