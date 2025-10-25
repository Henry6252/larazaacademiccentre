<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of all users (with roles).
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show listing of tutors (users with the tutor role).
     */
    public function tutorsIndex()
    {
        $tutors = User::role('tutor')
            ->with(['roles', 'courseAssignments' /* or courses pivot */])
            ->paginate(10);

        return view('admin.tutors.index', compact('tutors'));
    }

    /**
     * Show the form to assign courses + semester + academic year to a tutor.
     */
    public function showAssignForm($tutorId)
    {
        $tutor = User::findOrFail($tutorId);

        if (! $tutor->hasRole('tutor')) {
            abort(403, 'User is not a tutor');
        }

        $courses = Course::all();
        $semesters = Semester::all();
        $academicYears = AcademicYear::all();

        // Fetch existing assignments: pivot data
        $assigned = $tutor->courseAssignments()
            ->get()
            ->mapWithKeys(function ($course) {
                return [
                    $course->id => [
                        'semester_id' => $course->pivot->semester_id,
                        'academic_year_id' => $course->pivot->academic_year_id,
                    ],
                ];
            })
            ->toArray();

        return view('admin.tutors.assign_courses', [
            'tutor' => $tutor,
            'courses' => $courses,
            'semesters' => $semesters,
            'academicYears' => $academicYears,
            'assigned' => $assigned,
        ]);
    }

    /**
     * Handle the assignment submission: courses + semester + academic year.
     */
    public function assign(Request $request, $tutorId)
    {
        $tutor = User::findOrFail($tutorId);

        if (! $tutor->hasRole('tutor')) {
            abort(403, 'User is not a tutor');
        }

        $validated = $request->validate([
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $courseIds = $validated['courses'];
        $semesterId = $validated['semester_id'];
        $academicYearId = $validated['academic_year_id'];

        // Build sync data with pivot fields
        $syncData = [];
        foreach ($courseIds as $cid) {
            $syncData[$cid] = [
                'semester_id' => $semesterId,
                'academic_year_id' => $academicYearId,
            ];
        }

        $tutor->courseAssignments()->sync($syncData);

        return redirect()->route('admin.tutors.index')
            ->with('success', 'Courses, semester and year assigned successfully.');
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|exists:roles,name',
        ]);

        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:6|confirmed',
            ]);
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
