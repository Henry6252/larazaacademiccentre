<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\EnrollmentController;
use App\Http\Controllers\Student\AssignmentsController;
use App\Http\Controllers\Tutor\AssessmentController;

use App\Http\Controllers\Tutor\GradeController as TutorGradeController;
use App\Http\Controllers\Student\GradeController as StudentGradeController;
use App\Http\Controllers\Admin\GradeController as AdminGradeController;
use App\Http\Controllers\Tutor\GradeExportController as TutorGradeExportController;
use App\Http\Controllers\Admin\GradeExportController as AdminGradeExportController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Tutor\MaterialController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\TutorCourseController;
use App\Http\Controllers\Student\MyCoursesController;
use App\Http\Controllers\Tutor\DashboardController;
use App\Http\Controllers\Tutor\ClassController;
use App\Http\Controllers\Tutor\CourseController;
use App\Http\Controllers\Student\UnitController;
use App\Http\Controllers\Admin\SystemSettingsController;
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    UserController,
    SemesterController,
    DepartmentController,
    AssignmentController,
    SettingController
};

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Super Admin Routes
Route::prefix('super-admin')->middleware(['auth', 'role:super-admin'])->name('superadmin.')->group(function () {
    Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admins', [SuperAdminController::class, 'index'])->name('admins.index');
    Route::get('admins/create', [SuperAdminController::class, 'create'])->name('admins.create');
    Route::post('admins', [SuperAdminController::class, 'store'])->name('admins.store');
    Route::get('admins/{id}/edit', [SuperAdminController::class, 'edit'])->name('admins.edit');
    Route::put('admins/{id}', [SuperAdminController::class, 'update'])->name('admins.update');
    Route::delete('admins/{id}', [SuperAdminController::class, 'destroy'])->name('admins.destroy');

    Route::resource('users', UserController::class);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
// ADMIN GRADES
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('grades', [AdminGradeController::class, 'index'])->name('grades.index');
        Route::get('grades/student/{student}', [AdminGradeController::class, 'student'])->name('grades.student');
    });
    // Users
    Route::resource('users', UsersController::class);
// Admin exports
Route::get('admin/grades/export/excel', [AdminGradeExportController::class, 'exportExcel'])->name('admin.grades.export.excel');
Route::get('admin/grades/export/pdf', [AdminGradeExportController::class, 'exportPDF'])->name('admin.grades.export.pdf');
    // Courses and nested Units
    Route::resource('courses', AdminCourseController::class);
    Route::resource('courses.units', App\Http\Controllers\Admin\CourseUnitController::class);

    // Tutors
    Route::resource('tutors', TutorCourseController::class);
    Route::get('/tutors/{tutor}/assign', [TutorCourseController::class, 'assignForm'])->name('tutors.assign_courses.form');
    Route::post('/tutors/{tutor}/assign', [TutorCourseController::class, 'storeAssign'])->name('tutors.assign_courses');
    Route::get('/tutors', [TutorCourseController::class, 'index'])->name('tutors.index');
Route::middleware(['auth', 'role:tutor'])->prefix('tutor')->name('tutor.')->group(function () {
    Route::post('assessments/store', [AssessmentController::class, 'store'])->name('assessments.store');
    Route::get('assessments/unit/{unit}', [AssessmentController::class, 'unit'])->name('assessments.unit');
    Route::get('assessments/create/{unit}', [AssessmentController::class, 'create'])->name('assessments.create');
});
Route::get('assessments/store', function() {
    return redirect()->back();
});

    // Semesters
    Route::resource('semesters', SemesterController::class);

    // Departments
    Route::resource('departments', DepartmentController::class);

    // Assignments
    Route::resource('assignments', AssignmentController::class);

    // Academic Years
    Route::resource('academic-years', AcademicYearController::class);

    // Enrollments
    Route::resource('enrollments', EnrollmentController::class);

    // Reports (only index)
    Route::resource('reports', ReportController::class)->only(['index']);

    // System Settings
    Route::get('/systemsettings', [SystemSettingsController::class, 'index'])->name('systemsettings.index');
    Route::post('/systemsettings', [SystemSettingsController::class, 'update'])->name('systemsettings.update');

    // Course Assignments
    Route::get('course-assignments', [\App\Http\Controllers\Admin\CourseAssignmentController::class, 'index'])->name('course_assignments.index');
    Route::post('course-assignments', [\App\Http\Controllers\Admin\CourseAssignmentController::class, 'store'])->name('course_assignments.store');
    Route::delete('course-assignments/{id}', [\App\Http\Controllers\Admin\CourseAssignmentController::class, 'destroy'])->name('course_assignments.destroy');
});


Route::prefix('tutor')
    ->middleware(['auth', 'role:tutor'])
    ->name('tutor.')
    ->group(function () {

        // -------------------------
        // DASHBOARD
        // -------------------------
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // -------------------------
        // CLASSES
        // -------------------------
        Route::resource('classes', ClassController::class);

        // -------------------------
        // COURSES & UNITS
        // -------------------------
        Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('/courses/{course}/units', [CourseController::class, 'showUnits'])->name('courses.units');

        // -------------------------
        // MATERIALS (through units)
        // -------------------------
        Route::get('units/{unit}/materials/upload', [MaterialController::class, 'create'])->name('materials.create');
        Route::post('units/{unit}/materials', [MaterialController::class, 'store'])->name('materials.store');
        Route::get('materials', [MaterialController::class, 'index'])->name('materials.index');

        // -------------------------
        // GRADES (Tutor Grade Dashboard)
        // -------------------------
        Route::get('grades', [TutorGradeController::class, 'index'])->name('grades.index');
        Route::get('grades/unit/{course_unit}', [TutorGradeController::class, 'unit'])->name('grades.unit');

        // -------------------------
        // ASSESSMENTS
        // -------------------------
        Route::get('assessments', [AssessmentController::class, 'index'])->name('assessments.index');
        Route::get('assessments/unit/{unit}', [AssessmentController::class, 'showUnit'])->name('assessments.unit');
        Route::get('assessments/create/{unit}', [AssessmentController::class, 'create'])->name('assessments.create');
        Route::post('assessments/store', [AssessmentController::class, 'store'])->name('assessments.store');
        Route::get('assessments/{assessment}/submissions', [AssessmentController::class, 'viewSubmissions'])->name('assessments.submissions');
        Route::post('assessments/{submission}/grade', [AssessmentController::class, 'grade'])->name('assessments.grade');

        // -------------------------
        // ATTENDANCE
        // -------------------------
        Route::resource('attendance', AttendanceController::class);

        // -------------------------
        // ASSIGNED COURSES (View only)
        // -------------------------
        Route::get('/assigned-courses', [TutorCourseController::class, 'assignedCourses'])->name('assignedcourses.index');
    });

// Student Routes
// Student Routes
Route::prefix('student')->middleware(['auth', 'role:student'])->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        return view('student.dashboard', ['showSidebar' => true]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::resource('assignments', AssignmentController::class);
// For Students
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('assignments', [App\Http\Controllers\Student\AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('assignments/{unit}', [App\Http\Controllers\Student\AssignmentController::class, 'showUnitAssessments'])->name('assignments.unit');
    Route::get('assessments/{assessment}', [App\Http\Controllers\Student\AssignmentController::class, 'takeAssessment'])->name('assessments.take');
    Route::post('assessments/{assessment}/submit', [App\Http\Controllers\Student\AssignmentController::class, 'submitAssessment'])->name('assessments.submit');
});

    // Courses
    Route::get('courses', [\App\Http\Controllers\Student\RegistrationController::class, 'index'])->name('courses.index');
    Route::post('courses/register', [\App\Http\Controllers\Student\RegistrationController::class, 'register'])->name('courses.register');

    // Units for a course
    Route::get('courses/{course}/units', [\App\Http\Controllers\Student\CourseController::class, 'showUnits'])->name('courses.units');

    // **Single unit detail (clickable)**
    Route::get('units/{unit}', [\App\Http\Controllers\Student\UnitController::class, 'show'])->name('units.show');

    // My courses
    Route::get('/mycourses', [MyCoursesController::class, 'index'])->name('mycourses.index');
    Route::post('/mycourses/{course}/enroll', [MyCoursesController::class, 'enroll'])->name('mycourses.enroll');

    // Grades
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('units/{unit}', [App\Http\Controllers\Student\UnitController::class, 'show'])->name('units.show');
});
// STUDENT GRADES
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('grades', [StudentGradeController::class, 'index'])->name('grades.index');
    });
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('assignments', [Student\AssignmentController::class, 'index'])->name('assignments.index');
        Route::get('assignments/{assessment}', [Student\AssignmentController::class, 'show'])->name('assignments.show');
        Route::post('assignments/{assessment}/submit', [Student\AssignmentController::class, 'submit'])->name('assignments.submit');
    });


});


// Shared / Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('assignments', AssignmentsController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('mycourses', MyCoursesController::class);
});

// Default dashboard route (fallback or non-role specific)
Route::get('/dashboard', function () {
    return view('dashboard', ['showSidebar' => true]);
})->middleware(['auth'])->name('dashboard');

Route::get('/app', function () {
    return view('app');
})->middleware(['auth', 'verified'])->name('app');
