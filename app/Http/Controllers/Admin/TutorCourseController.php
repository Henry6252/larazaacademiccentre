<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use App\Models\AcademicYear;
use Spatie\Permission\Models\Role;     // <-- added this
use Illuminate\Http\Request;

class TutorCourseController extends Controller
{
    /**
     * Display a listing of tutors (with assigned courses).
     */
    public function index()
    {
        $tutors = User::role('tutor')
            ->with(['courseAssignments', 'roles'])
            ->paginate(10);

        return view('admin.tutors.index', compact('tutors'));
    }

    /**
     * Show the form to assign courses + semester + academic year to a tutor.
     */
    public function assignForm($tutorId)
    {
        $tutor = User::findOrFail($tutorId);

        if (! $tutor->hasRole('tutor')) {
            abort(403, 'User is not a tutor');
        }

        $courses = Course::all();
        $semesters = Semester::all();
        $academicYears = AcademicYear::all();

        $assigned = $tutor->courseAssignments()
            ->get()
            ->mapWithKeys(function ($course) {
                return [
                    $course->id => [
                        'semester_id'      => $course->pivot->semester_id,
                        'academic_year_id' => $course->pivot->academic_year_id,
                    ],
                ];
            })
            ->toArray();

        return view('admin.tutors.assign_courses', [
            'tutor'          => $tutor,
            'courses'        => $courses,
            'semesters'      => $semesters,
            'academicYears'  => $academicYears,
            'assigned'       => $assigned,
        ]);
    }

    /**
     * Show form to create a new tutor (or show roles to pick).
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.tutors.create', compact('roles'));
    }

    /**
     * Store (sync) the assignments of courses + semester + academic year.
     */
    public function storeAssign(Request $request, $tutorId)
    {
        $tutor = User::findOrFail($tutorId);

        if (! $tutor->hasRole('tutor')) {
            abort(403, 'User is not a tutor');
        }

        $validated = $request->validate([
            'courses'           => 'required|array',
            'courses.*'         => 'exists:courses,id',
            'semester_id'       => 'required|exists:semesters,id',
            'academic_year_id'  => 'required|exists:academic_years,id',
        ]);

        $courseIds      = $validated['courses'];
        $semesterId     = $validated['semester_id'];
        $academicYearId = $validated['academic_year_id'];

        $syncData = [];
        foreach ($courseIds as $cid) {
            $syncData[$cid] = [
                'semester_id'       => $semesterId,
                'academic_year_id'  => $academicYearId,
            ];
        }

        $tutor->courseAssignments()->sync($syncData);

        return redirect()->route('admin.tutors.index')
            ->with('success', 'Courses, semester, and academic year assigned successfully.');
    }
}
