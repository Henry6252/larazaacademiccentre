@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Record Attendance</h1>

    <form action="{{ route('tutor.attendance.store') }}" method="POST" class="bg-white p-6 shadow rounded">
        @csrf

        <div class="mb-4">
            <label class="block">Student</label>
            <select name="student_id" class="w-full border p-2 rounded" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Course</label>
            <select name="course_id" class="w-full border p-2 rounded" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Date</label>
            <input type="date" name="date" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Late">Late</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
