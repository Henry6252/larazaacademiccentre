@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-gradient-to-b from-gray-50 to-white shadow-xl rounded-2xl p-8 mt-12 border border-gray-200
             transform transition duration-500 ease-out hover:scale-105
             animate-fadeInUp">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center tracking-tight animate-pulse">
        Assign Courses, Semester & Year to Tutor
    </h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-center font-medium shadow-sm
                    transform transition duration-300 hover:scale-105">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.tutors.assign_courses', $tutor->id) }}" method="POST" class="space-y-8">
        @csrf

        <!-- Display tutor name -->
        <div class="group transition duration-300 hover:bg-gray-100 p-2 rounded-lg">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tutor</label>
            <input type="text" value="{{ $tutor->name }}" disabled
                class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-3 text-gray-700 font-medium cursor-not-allowed
                       focus:outline-none transition duration-300 focus:shadow-lg" />
        </div>

        <!-- Courses (multi-select) -->
        <div class="group transition duration-300 hover:shadow-lg">
            <label for="courses" class="block text-sm font-semibold text-gray-700 mb-2">Select Courses</label>
            <select name="courses[]" id="courses" multiple
                    class="w-full rounded-xl border border-gray-300 bg-white shadow-sm
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 py-3 px-4 text-gray-700
                           transform transition duration-300 hover:scale-105">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}"
                        {{ isset($assigned[$course->id]) ? 'selected' : '' }}>
                        {{ $course->code ?? '' }} {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('courses')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1">Hold <kbd class="bg-gray-200 px-1 rounded">Ctrl</kbd> / <kbd class="bg-gray-200 px-1 rounded">Cmd</kbd> to select multiple.</p>
        </div>

        <!-- Semester -->
        <div class="group transition duration-300 hover:shadow-lg">
            <label for="semester_id" class="block text-sm font-semibold text-gray-700 mb-2">Semester</label>
            <select name="semester_id" id="semester_id" required
                    class="w-full rounded-xl border border-gray-300 shadow-sm bg-white
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-3 px-4 text-gray-700
                           transform transition duration-300 hover:scale-105">
                <option value="">-- Select Semester --</option>
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}"
                        {{ old('semester_id', $assigned ? $assigned[array_key_first($assigned)]['semester_id'] ?? '' : '') == $semester->id ? 'selected' : '' }}>
                        {{ $semester->name }}
                    </option>
                @endforeach
            </select>
            @error('semester_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Academic Year -->
        <div class="group transition duration-300 hover:shadow-lg">
            <label for="academic_year_id" class="block text-sm font-semibold text-gray-700 mb-2">Academic Year</label>
            <select name="academic_year_id" id="academic_year_id" required
                    class="w-full rounded-xl border border-gray-300 shadow-sm bg-white
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 py-3 px-4 text-gray-700
                           transform transition duration-300 hover:scale-105">
                <option value="">-- Select Academic Year --</option>
                @foreach ($academicYears as $year)
                    <option value="{{ $year->id }}"
                        {{ old('academic_year_id', $assigned ? $assigned[array_key_first($assigned)]['academic_year_id'] ?? '' : '') == $year->id ? 'selected' : '' }}>
                        {{ $year->name }}
                    </option>
                @endforeach
            </select>
            @error('academic_year_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-center">
            <button type="submit"
                    class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-lg
                           hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300
                           transform transition duration-300 hover:scale-105">
                Save Assignment
            </button>
        </div>
    </form>
</div>
@endsection
