<?php

namespace App\Http\Controllers;

use App\Models\Grade; // <-- make sure this is here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        $grades = Grade::where('student_id', $student->id)->with('course')->get();

        return view('student.grades.index', compact('grades'));
    }
}
