@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Edit Grade</h1>

    <form action="{{ route('tutor.grades.update', $grade) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block">Student</label>
            <select name="student_id" class="w-full border p-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $grade->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Course</label>
            <select name="course_id" class="w-full border p-2">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $grade->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Grade</label>
            <input type="text" name="grade" class="w-full border p-2" value="{{ $grade->grade }}">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
