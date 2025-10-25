@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Grade</h2>
@endsection

@section('content')
<form action="{{ route('grades.update', $grade) }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf @method('PUT')

    <div class="mb-4">
        <label class="block">Student</label>
        <select name="student_id" class="w-full border p-2 rounded">
            @foreach($students as $student)
                <option value="{{ $student->id }}" {{ $grade->student_id == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block">Course</label>
        <select name="course_id" class="w-full border p-2 rounded">
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ $grade->course_id == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block">Grade</label>
        <input type="text" name="grade" class="w-full border p-2 rounded" value="{{ $grade->grade }}">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
