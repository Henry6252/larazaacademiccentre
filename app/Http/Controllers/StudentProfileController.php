<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Grade;

class StudentProfileController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        // Get enrolled courses (assuming pivot table `enrollments`)
        $courses = $student->courses()->with('instructor')->get();

        // Get student grades
        $grades = Grade::where('student_id', $student->id)->with('course')->get();

        return view('student.profile', compact('student', 'courses', 'grades'));
    }
}
