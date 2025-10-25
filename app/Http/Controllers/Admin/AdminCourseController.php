<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    // Show all courses
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    // Show form to create a new course
    public function create()
    {
        return view('admin.courses.create');
    }

    // Store new course
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:courses,code',
        'description' => 'nullable|string',
    ]);

    // Create the course
    $course = \App\Models\Course::create([
        'name' => $request->name,
        'code' => $request->code,          // make sure 'code' is included
        'description' => $request->description,
    ]);

    return redirect()->route('admin.courses.index')
        ->with('success', 'Course created successfully.');
}


    // Edit course
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    // Update course
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course->update($request->only('name', 'description'));

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    // Show single course details
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }
}
