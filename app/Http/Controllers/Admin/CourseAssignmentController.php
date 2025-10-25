<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Semester;

class CourseAssignmentController extends Controller
{
    public function index()
    {
        $assignments = \DB::table('course_tutor')
            ->join('users', 'users.id', '=', 'course_tutor.tutor_id')
            ->join('courses', 'courses.id', '=', 'course_tutor.course_id')
            ->join('semesters', 'semesters.id', '=', 'course_tutor.semester_id')
            ->select('course_tutor.*', 'users.name as tutor_name', 'courses.name as course_name', 'semesters.name as semester_name')
            ->get();

        return view('admin.course_assignments.index', compact('assignments'));
    }

    public function create()
    {
        $tutors = User::role('tutor')->get();
        $courses = Course::all();
        $semesters = Semester::with('academicYear')->get();

        return view('admin.course_assignments.create', compact('tutors', 'courses', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        // Prevent duplicate assignment
        $exists = \DB::table('course_tutor')
            ->where('tutor_id', $request->tutor_id)
            ->where('course_id', $request->course_id)
            ->where('semester_id', $request->semester_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This tutor is already assigned to this course for the selected semester.');
        }

        \DB::table('course_tutor')->insert([
            'tutor_id' => $request->tutor_id,
            'course_id' => $request->course_id,
            'semester_id' => $request->semester_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.course_assignments.index')
                         ->with('success', 'Course assigned to tutor successfully!');
    }

    public function destroy($id)
    {
        \DB::table('course_tutor')->where('id', $id)->delete();
        return redirect()->route('admin.course_assignments.index')
                         ->with('success', 'Course assignment deleted!');
    }
}
