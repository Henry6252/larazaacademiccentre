<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUnit;
use App\Models\Assessment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    // Show courses and units assigned to the student
    public function index()
    {
        $student = Auth::user();

        // Fetch courses where the student is enrolled
        $courses = $student->courses()->with('units')->get();

        return view('student.assignments.index', compact('courses'));
    }

    // View assessments under a specific unit
    public function viewAssessments($unitId)
    {
        $unit = CourseUnit::with('assessments')->findOrFail($unitId);
        return view('student.assignments.assessments', compact('unit'));
    }

    // Submit answers
    public function submit(Request $request, $assessmentId)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        Submission::create([
            'student_id' => Auth::id(),
            'assessment_id' => $assessmentId,
            'answers' => json_encode($request->answers),
        ]);

        return redirect()->back()->with('success', 'Assessment submitted successfully!');
    }
}
