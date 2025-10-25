<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Models\CourseUnit;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display all materials uploaded by the logged-in tutor.
     */
    public function index()
    {
        

    $materials = auth()->user()->materials ?? []; // adjust depending on your relationship
    return view('tutor.materials.index', compact('materials'));


        $materials = CourseMaterial::where('user_id', auth()->id())
            ->with(['unit', 'course'])
            ->latest()
            ->get();

        return view('tutor.materials.index', compact('materials'));
    }

    /**
     * Store a newly uploaded course material.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'unit_id'     => 'required|exists:course_units,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar|max:10240',
        ]);

        // ✅ Find the course unit
        $unit = CourseUnit::findOrFail($validated['unit_id']);

        // ✅ Store the file
        $filePath = $request->file('file')->store('course_materials', 'public');

        // ✅ Create the course material record
        CourseMaterial::create([
            'unit_id'     => $unit->id,
            'course_id'   => $unit->course_id,
            'user_id'     => auth()->id(),
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'file_path'   => $filePath,
        ]);

        return redirect()->back()->with('success', 'Material uploaded successfully.');
    }

    /**
     * Delete a material (optional cleanup).
     */
    public function destroy(CourseMaterial $material)
    {
        // Ensure the tutor owns this material
        if ($material->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the file from storage
        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        // Delete the database record
        $material->delete();

        return redirect()->back()->with('success', 'Material deleted successfully.');
    }
}
