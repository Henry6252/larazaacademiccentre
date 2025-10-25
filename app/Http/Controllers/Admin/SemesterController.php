<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\AcademicYear;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::with('academicYear')->latest()->get();
        return view('admin.semesters.index', compact('semesters'));
    }

    public function create()
{
    $academicYears = AcademicYear::all(); // Fetch all academic years
    return view('admin.semesters.create', compact('academicYears')); // Pass to view
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        Semester::create($request->only('name', 'academic_year_id'));

        return redirect()->route('admin.semesters.index')
                         ->with('success', 'Semester created successfully!');
    }

    public function edit(Semester $semester)
{
    $academicYears = AcademicYear::all();
    return view('admin.semesters.edit', compact('semester', 'academicYears'));
}


    public function update(Request $request, Semester $semester)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $semester->update($request->only('name', 'academic_year_id'));

        return redirect()->route('admin.semesters.index')
                         ->with('success', 'Semester updated successfully!');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->route('admin.semesters.index')
                         ->with('success', 'Semester deleted successfully!');
    }
}
