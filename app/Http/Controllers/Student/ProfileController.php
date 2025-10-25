<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Assignment;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        // 🟢 Fetch the student's enrolled courses via enrollments
        $courses = collect();
        if ($student) {
            $courses = $student->enrollments()
                ->with('course.tutor.user') // eager load course and tutor
                ->get()
                ->pluck('course');
        }

        // 🟢 Fetch the student's grades (if you have a Grade model)
        $grades = collect();
        if ($student && method_exists($student, 'grades')) {
            $grades = $student->grades()->with('course')->get();
        }

         $assignments = collect();
    if ($courses->isNotEmpty()) {
        $assignments = Assignment::whereIn('course_id', $courses->pluck('id'))
            ->orderBy('due_date', 'asc')
            ->get();
    }

    return view('student.profile.index', compact('user', 'student', 'courses', 'grades', 'assignments'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $student = Student::where('user_id', Auth::id())->first();
        if ($student) {
            $student->update($request->only(['phone', 'address']));
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
