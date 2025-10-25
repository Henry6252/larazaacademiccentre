<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentController extends Controller
{
    /**
     * Display all enrolled courses for the logged-in student.
     */
    public function index()
    {
        $user = Auth::user();

        // Ensure student record exists
        $student = $user->student;
        if (!$student) {
            $student = Student::create(['user_id' => $user->id]);
        }

        // Load enrollments with related course + tutors + materials
        $enrollments = Enrollment::where('student_id', $student->id)
            ->with(['course.tutors', 'course.materials.tutor'])
            ->latest()
            ->get();

        // Return correct view path
        return view('student.enrollments.index', compact('enrollments'));
    }

    /**
     * Show units for a specific enrolled course.
     */
    public function showUnits(Course $course)
    {
        $user = Auth::user();
        $student = $user->student;

        // Verify that the student is enrolled in this course
        if (!$student->enrollments()->where('course_id', $course->id)->exists()) {
            abort(403, 'Unauthorized');
        }

        // Fetch all units for this course, including materials
        $units = $course->units()->with('materials')->get();

        return view('student.courses.units', compact('course', 'units'));
    }

    /**
     * Enroll the student in a specific course.
     */
    public function enroll(Request $request, $courseId)
    {
        $user = Auth::user();
        $student = $user->student ?? Student::create(['user_id' => $user->id]);
        $course = Course::findOrFail($courseId);

        // Prevent duplicate enrollment
        if (Enrollment::where('student_id', $student->id)->where('course_id', $courseId)->exists()) {
            return back()->with('info', 'You are already enrolled in this course.');
        }

        Enrollment::create([
            'student_id' => $student->id,
            'course_id'  => $courseId,
        ]);

        return back()->with('success', 'Successfully enrolled in ' . $course->name . '!');
    }

    /**
     * Unenroll from a course.
     */
    public function unenroll($courseId)
    {
        $user = Auth::user();
        $student = $user->student;

        Enrollment::where('student_id', $student->id)
            ->where('course_id', $courseId)
            ->delete();

        return back()->with('info', 'You have unenrolled from the course.');
    }
}
