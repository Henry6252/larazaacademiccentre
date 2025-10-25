<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'course'])->latest()->paginate(10);
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $students = User::role('student')->get();
        $courses = Course::all();
        return view('attendance.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        Attendance::create($request->all());

        return redirect()->route('teacher.attendance.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $students = User::role('student')->get();
        $courses = Course::all();
        return view('attendance.edit', compact('attendance', 'students', 'courses'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        $attendance->update($request->all());

        return redirect()->route('teacher.attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('teacher.attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}
