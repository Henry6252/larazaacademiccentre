<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classroom::with('course','tutor')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $tutors = User::role('tutor')->get();
        $courses = Course::all();
        return view('admin.classes.create', compact('tutors','courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'semester' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'tutor_id' => 'required|exists:users,id',
        ]);

        Classroom::create($request->all());
        return redirect()->route('admin.classes.index')->with('success','Class created successfully.');
    }
}
