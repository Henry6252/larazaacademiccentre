<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseUnit;

class UnitController extends Controller
{
    // Show a single unit
    public function show($id)
    {
        $unit = CourseUnit::with('materials')->findOrFail($id);
        return view('student.units.show', compact('unit'));
    }
}
