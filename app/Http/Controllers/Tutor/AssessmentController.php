<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\CourseUnit;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        // Fetch course units where the logged-in tutor is assigned to the parent course
        $tutorId = auth()->id();

        $courseUnits = CourseUnit::whereHas('course.tutors', function ($q) use ($tutorId) {
            $q->where('tutor_id', $tutorId);
        })->get();

        return view('tutor.assessments.index', compact('courseUnits'));
    }

    public function showUnit($courseUnitId)
    {
        $unit = CourseUnit::findOrFail($courseUnitId);
        $assessments = Assessment::where('course_unit_id', $courseUnitId)->get();

        return view('tutor.assessments.unit', compact('unit', 'assessments'));
    }

    public function create($courseUnitId)
    {
        $unit = CourseUnit::findOrFail($courseUnitId);
        return view('tutor.assessments.create', compact('unit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
    'course_unit_id' => 'required|exists:course_units,id',
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'total_marks' => 'required|numeric|min:1',
    'due_date' => 'required|date', 
]);

// ✅ Automatically assign tutor_id from the logged-in tutor
$validated['tutor_id'] = auth()->id();

Assessment::create($validated);


        return redirect()->route('tutor.assessments.unit', $validated['course_unit_id'])
                         ->with('success', 'Assessment created successfully.');
    }

    public function viewSubmissions($assessmentId)
    {
        $assessment = Assessment::with('submissions.student')->findOrFail($assessmentId);
        return view('tutor.assessments.submissions', compact('assessment'));
    }

    public function grade(Request $request, $submissionId)
    {
        $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
        ]);

        $submission = \App\Models\Submission::findOrFail($submissionId);
        $submission->update(['grade' => $request->grade]);

        return back()->with('success', 'Grade updated successfully.');
    }
}
