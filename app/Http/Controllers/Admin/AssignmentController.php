<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of assignments.
     */
    public function index()
    {
       $assignments = Assignment::paginate(10);

    return view('admin.assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new assignment.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.assignments.create', compact('courses'));
    }

    /**
     * Store a newly created assignment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'course_id'   => 'required|exists:courses,id',
            'status'      => 'required|in:pending,submitted,graded',
        ]);

        Assignment::create($request->all());

        return redirect()->route('admin.assignments.index')
                         ->with('success', 'Assignment created successfully.');
    }

    /**
     * Show the form for editing the specified assignment.
     */
    public function edit(Assignment $assignment)
    {
        $courses = Course::all();
        return view('admin.assignments.edit', compact('assignment', 'courses'));
    }

    /**
     * Update the specified assignment in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'course_id'   => 'required|exists:courses,id',
            'status'      => 'required|in:pending,submitted,graded',
        ]);

        $assignment->update($request->all());

        return redirect()->route('admin.assignments.index')
                         ->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified assignment from storage.
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('admin.assignments.index')
                         ->with('success', 'Assignment deleted successfully.');
    }
}
