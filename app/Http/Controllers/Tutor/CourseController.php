<?php

namespace App\Http\Controllers\Tutor;
use App\Models\CourseMaterial;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a list of courses assigned to the logged-in tutor.
     */
    public function index()
{
    $tutor = Auth::user();

    // ✅ Correct relationship
    $courses = $tutor->courses()
        ->with(['semester', 'academicYear'])
        ->get();

    return view('tutor.courses.index', compact('courses'));
}

public function storeMaterial(Request $request, $courseId)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'file' => 'required|file|max:10240', // 10MB
    ]);

    $path = $request->file('file')->store('materials', 'public');

    CourseMaterial::create([
    'course_id' => $courseId,
    'unit_id'   => $unitId,         // <-- add this
    'user_id'   => auth()->id(),
    'title'     => $request->title,
    'description' => $request->description,
    'file_path' => $path,
]);


    return redirect()->back()->with('success', 'Material uploaded successfully!');
}
    /**
     * Display details of a specific assigned course.
     */
    public function show($id)
{
    $tutor = Auth::user();

    // Fetch the course only if it's assigned to this tutor
    $course = $tutor->courses()
        ->with(['semester', 'academicYear', 'materials']) // ✅ include materials here
        ->where('courses.id', $id)
        ->first();

    if (! $course) {
        abort(403, 'You do not have access to this course.');
    }

    // Get materials for the course
    $materials = $course->materials; // ✅ define materials variable

    // Ensure the logged-in tutor owns this course
    if (! $course->tutors->contains($tutor->id)) {
        abort(403, 'Unauthorized');
    }
 $course = Course::with('units.materials')->findOrFail($id);
   return view('tutor.courses.show', compact('course'));
    // ✅ Return both course and materials to the view
    return view('tutor.courses.show', compact('course', 'materials'));
}
public function showUnits(Course $course)
{
    $tutor = Auth::user();

    if (!$course->tutors->contains($tutor->id)) {
        abort(403, 'Unauthorized');
    }

    $units = $course->units()->with('materials')->get();

    return view('tutor.courses.units', compact('course', 'units'));
}

    /**
     * Allow tutor to update limited course details (optional).
     */
    public function update(Request $request, $id)
    {
        $tutor = Auth::user();

        $course = $tutor->courses()->where('courses.id', $id)->firstOrFail();

        $validated = $request->validate([
            'description' => 'nullable|string|max:2000',
        ]);

        $course->update($validated);

        return redirect()
            ->route('tutor.courses.show', $id)
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Allow tutor to detach a course (optional).
     */
    public function destroy($id)
    {
        $tutor = Auth::user();

        $tutor->courses()->detach($id);

        return redirect()
            ->route('tutor.courses.index')
            ->with('success', 'Course unassigned successfully.');
    }
}
