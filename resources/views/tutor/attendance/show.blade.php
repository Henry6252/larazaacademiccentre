@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md bg-white p-6 shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Attendance Details</h1>

    <p><strong>Student:</strong> {{ $attendance->student->name }}</p>
    <p><strong>Course:</strong> {{ $attendance->course->title }}</p>
    <p><strong>Date:</strong> {{ $attendance->date }}</p>
    <p><strong>Status:</strong> {{ $attendance->status }}</p>

    <div class="mt-4">
        <a href="{{ route('tutor.attendance.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
        <a href="{{ route('tutor.attendance.edit', $attendance) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
    </div>
</div>
@endsection
