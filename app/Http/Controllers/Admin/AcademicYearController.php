<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;

class AcademicYearController extends Controller
{
    // Display a listing of academic years
    public function index()
{
    $academicYears = AcademicYear::latest()->get();
    return view('admin.academic-years.index', compact('academicYears'));
}


    // Show the form for creating a new academic year
    public function create()
    {
        return view('admin.academic-years.create');
    }

    // Store a newly created academic year in the database
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:255|unique:academic_years,year',
        ]);

        AcademicYear::create([
            'year' => $request->year,
        ]);

        return redirect()->route('admin.academic-years.index')
                         ->with('success', 'Academic Year created successfully!');
    }

    // Show the form for editing the specified academic year
    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic-years.edit', compact('academicYear'));
    }

    // Update the specified academic year in the database
    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'year' => 'required|string|max:255|unique:academic_years,year,' . $academicYear->id,
        ]);

        $academicYear->update([
            'year' => $request->year,
        ]);

        return redirect()->route('admin.academic-years.index')
                         ->with('success', 'Academic Year updated successfully!');
    }

    // Delete the specified academic year
    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();

        return redirect()->route('admin.academic-years.index')
                         ->with('success', 'Academic Year deleted successfully!');
    }
}
