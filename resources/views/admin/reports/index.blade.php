@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Admin Reports</h1>
    <p class="mb-6">Here you can view system reports and statistics.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Student Enrollments</h2>
            <p class="text-gray-600">Number of students enrolled this semester.</p>
            <span class="text-3xl font-bold text-blue-600">{{ $studentCount }}</span>
        </div>

        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Courses Offered</h2>
            <p class="text-gray-600">Active courses available this semester.</p>
            <span class="text-3xl font-bold text-green-600">{{ $courseCount }}</span>
        </div>

        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Pending Assignments</h2>
            <p class="text-gray-600">Assignments waiting for grading.</p>
            <span class="text-3xl font-bold text-red-600">{{ $pendingAssignments }}</span>
        </div>
    </div>
</div>
@endsection
