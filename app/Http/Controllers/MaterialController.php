<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Models\CourseUnit;

class MaterialController extends Controller
{
    // Show upload form for a specific unit
    public function create($unitId)
    {
        $unit = CourseUnit::with('course')->findOrFail($unitId);

        return view('tutor.materials.create', [
            'unit' => $unit,
        ]);
    }

    // Store uploaded material
    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_id'     => 'required|exists:course_units,id',
            'title'       => 'required|string|max:255',
            'file'        => 'required|file|mimes:pdf,doc,docx,ppt,pptx',
            'description' => 'nullable|string',
        ]);

        $unit = CourseUnit::findOrFail($validated['unit_id']);
        $filePath = $request->file('file')->store('course_materials', 'public');

        CourseMaterial::create([
            'course_id'   => $unit->course_id,
            'unit_id'     => $unit->id,
            'user_id'     => auth()->id(),
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'file_path'   => $filePath,
        ]);

        return redirect()
            ->route('tutor.courses.units', $unit->course_id)
            ->with('success', 'Material uploaded successfully.');
    }
}
