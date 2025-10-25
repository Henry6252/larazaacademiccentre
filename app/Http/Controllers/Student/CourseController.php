<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Show units for a specific enrolled course.
     */
    public function showUnits($courseId)
    {
        $course = Course::with('units')->findOrFail($courseId);

        return view('student.courses.units', compact('course'));
    }
}
