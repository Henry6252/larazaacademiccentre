@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded mt-6">
    <h2 class="text-2xl font-bold mb-4">Assign Course to Tutor</h2>

    <form action="{{ route('admin.course_assignments.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Tutor</label>
            <select name="tutor_id" class="w-full border rounded p-2">
                <option value="">Select Tutor</option>
                @foreach($tutors as $tutor)
                    <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Semester</label>
            <select name="semester_id" class="w-full border rounded p-2">
                <option value="">Select Semester</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->name }} ({{ $semester->academicYear->year }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Course</label>
            <select name="course_id" class="w-full border rounded p-2">
                <option value="">Select Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Assign Course</button>
    </form>
</div>
@endsection
