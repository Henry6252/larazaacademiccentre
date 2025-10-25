<?php

// app/Http/Controllers/Student/MyCourseController.php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyCoursesController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $student = $user->student;

    if (!$student) {
        $student = \App\Models\Student::create(['user_id' => $user->id]);
    }

    $enrolledCourseIds = $student->enrollments()->pluck('course_id')->toArray();

    // ✅ Load all courses with tutors relationship
    $courses = \App\Models\Course::with('tutors')->get();

    return view('student.mycourses.index', compact('courses', 'enrolledCourseIds'));
}


    public function enroll(Request $request, $courseId)
{
    $user = auth()->user();

    // Ensure student record exists
    $student = $user->student;
    if (!$student) {
        $student = Student::create(['user_id' => $user->id]);
    }

    // Check if already enrolled
    $already = Enrollment::where('student_id', $student->id)
        ->where('course_id', $courseId)
        ->exists();

    if ($already) {
        return back()->with('info', 'Already enrolled in this course.');
    }

    // Create enrollment
    Enrollment::create([
        'student_id' => $student->id,
        'course_id'  => $courseId, // ✅ using the route parameter
    ]);

    return back()->with('success', 'Successfully enrolled in course!');
}
}