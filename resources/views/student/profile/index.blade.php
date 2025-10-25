@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">My Profile</h1>

    <!-- Student Info -->
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Student Information</h2>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Student ID:</strong> {{ $student->id }}</p>
        <p><strong>Program:</strong> {{ $student->program ?? 'N/A' }}</p>
    </div>

    <!-- Enrolled Courses -->
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">My Courses</h2>
        @if($courses->count())
            <ul class="list-disc pl-6">
                @foreach($courses as $course)
                    <li>{{ $course->name }} ({{ $course->code }})</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No courses enrolled yet.</p>
        @endif
    </div>

    <!-- Grades -->
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">My Grades</h2>
        @if($grades->count())
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-2 py-1">Course</th>
                        <th class="border px-2 py-1">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td class="border px-2 py-1">{{ $grade->course->name }}</td>
                            <td class="border px-2 py-1">{{ $grade->grade }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No grades available.</p>
        @endif
    </div>

    <!-- Recent Assignments -->
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-2">Recent Assignments</h2>
        @if($assignments->count())
            <ul class="list-disc pl-6">
                @foreach($assignments as $assignment)
                    <li>{{ $assignment->title }} ({{ $assignment->course->name }}) - Due {{ $assignment->due_date }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No assignments yet.</p>
        @endif
    </div>
</div>
@endsection
