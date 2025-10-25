<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUnit;
use Illuminate\Http\Request;

class CourseUnitController extends Controller
{
    // Display all units for a course
    public function index(Course $course)
    {
        $units = $course->units()->orderBy('created_at', 'desc')->get();
        return view('admin.courses.units.index', compact('course', 'units'));
    }

    // Show form to create a unit
    public function create(Course $course)
    {
        return view('admin.courses.units.create', compact('course'));
    }

    // Store new unit
  public function store(Request $request, $courseId)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50',
        'description' => 'nullable|string',
    ]);

    // Create the unit with course_id explicitly
    CourseUnit::create([
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
        'course_id' => $courseId,   // ✅ explicitly set course_id
    ]);

    return redirect()
        ->route('admin.courses.units.create', $courseId)
        ->with('success', 'Unit added successfully!');
}


    // Show form to edit a unit
    public function edit(Course $course, CourseUnit $unit)
    {
        return view('admin.courses.units.edit', compact('course', 'unit'));
    }

    // Update a unit
    public function update(Request $request, Course $course, CourseUnit $unit)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $unit->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.courses.units.index', $course->id)
                         ->with('success', 'Unit updated successfully!');
    }

    // Delete a unit
    public function destroy(Course $course, CourseUnit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.courses.units.index', $course->id)
                         ->with('success', 'Unit deleted successfully!');
    }
}
