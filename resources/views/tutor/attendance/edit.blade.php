@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Attendance</h1>

    <form action="{{ route('tutor.attendance.update', $attendance) }}" method="POST" class="bg-white p-6 shadow rounded">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block">Student</label>
            <select name="student_id" class="w-full border p-2 rounded" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $attendance->student_id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Course</label>
            <select name="course_id" class="w-full border p-2 rounded" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $attendance->course_id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Date</label>
            <input type="date" name="date" value="{{ $attendance->date }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                <option value="Late" {{ $attendance->status == 'Late' ? 'selected' : '' }}>Late</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
