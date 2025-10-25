<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('course', 'user')
            ->whereIn('course_id', auth()->user()->courses->pluck('id')) // only registered courses
            ->get();

        return view('student.materials.index', compact('materials'));
    }
    // In your MaterialController
public function create()
{
    $courses = Course::where('tutor_id', auth()->id())->get(); // fetch only assigned courses
    return view('tutor.materials.create', compact('courses'));
}

}
