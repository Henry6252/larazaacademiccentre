<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('tutor.attendance.index');
    }
}
