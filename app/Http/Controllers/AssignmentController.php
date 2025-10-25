<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the assignments.
     */
    public function index()
    {
        $assignments = Assignment::latest()->paginate(10);
        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new assignment.
     */
    public function create()
    {
        return view('assignments.create');
    }

    /**
     * Store a newly created assignment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        Assignment::create($request->all());

        return redirect()->route('assignments.index')
                         ->with('success', 'Assignment created successfully.');
    }

    /**
     * Display the specified assignment.
     */
    public function show(Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified assignment.
     */
    public function edit(Assignment $assignment)
    {
        return view('assignments.edit', compact('assignment'));
    }

    /**
     * Update the specified assignment in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        $assignment->update($request->all());

        return redirect()->route('assignments.index')
                         ->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified assignment from storage.
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignments.index')
                         ->with('success', 'Assignment deleted successfully.');
    }
}
