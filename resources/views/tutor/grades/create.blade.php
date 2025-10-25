@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Add Grade</h1>

    <form action="{{ route('tutor.grades.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block">Student</label>
            <select name="student_id" class="w-full border p-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Course</label>
            <select name="course_id" class="w-full border p-2">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Grade</label>
            <input type="text" name="grade" class="w-full border p-2" placeholder="e.g., A, B+, C-">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
