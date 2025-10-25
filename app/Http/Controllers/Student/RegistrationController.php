<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index()
    {
        $semesters = Semester::with('academicYear')->get();
        $courses = Course::all();

        return view('student.courses', compact('semesters', 'courses'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $exists = Registration::where('student_id', auth()->id())
            ->where('course_id', $request->course_id)
            ->where('semester_id', $request->semester_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You are already registered for this course in the selected semester.');
        }

        Registration::create([
            'student_id' => auth()->id(),
            'course_id' => $request->course_id,
            'semester_id' => $request->semester_id,
        ]);

        return redirect()->back()->with('success', 'Course registered successfully!');
    }
}
