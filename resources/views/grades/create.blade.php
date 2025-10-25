@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Grade</h2>
@endsection

@section('content')
<form action="{{ route('grades.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf

    <div class="mb-4">
        <label class="block">Student</label>
        <select name="student_id" class="w-full border p-2 rounded">
            <option value="">Select Student</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block">Course</label>
        <select name="course_id" class="w-full border p-2 rounded">
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block">Grade</label>
        <input type="text" name="grade" class="w-full border p-2 rounded" placeholder="e.g., A, B+, C-">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection
