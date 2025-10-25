<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classroom::with('course')
            ->where('tutor_id', Auth::id())
            ->get();

        return view('tutor.classes.index', compact('classes'));
    }
    
}
