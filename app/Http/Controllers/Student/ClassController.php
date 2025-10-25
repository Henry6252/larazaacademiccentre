<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Submission;

class AssignmentController extends Controller
{
    public function index()
    {
        $enrolledUnits = auth()->user()->enrolledUnits->pluck('id'); // Adjust this relation
        $assessments = Assessment::whereIn('course_unit_id', $enrolledUnits)->get();

        return view('student.assignments.index', compact('assessments'));
    }

    public function show($id)
    {
        $assessment = Assessment::findOrFail($id);
        $submission = Submission::where('assessment_id', $id)
                                ->where('student_id', auth()->id())
                                ->first();

        return view('student.assignments.show', compact('assessment', 'submission'));
    }

    public function submit(Request $request, $assessmentId)
    {
        $data = $request->validate([
            'file' => 'nullable|file|max:4096',
            'answer_text' => 'nullable|string'
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('submissions', 'public');
        }

        $data['assessment_id'] = $assessmentId;
        $data['student_id'] = auth()->id();

        Submission::create($data);

        return redirect()->route('student.assignments.index')->with('success', 'Assignment submitted successfully.');
    }
}
