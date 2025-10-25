@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-6">
    <h2 class="text-3xl font-bold text-blue-700 mb-6 flex items-center gap-2">
        📘 Available Courses
    </h2>

    @if(session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
    @elseif(session('info'))
        <div class="mb-4 p-3 rounded-lg bg-blue-100 text-blue-700 border border-blue-300">
            {{ session('info') }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
            <div class="border rounded-xl shadow-sm hover:shadow-md p-5 bg-gradient-to-br from-blue-50 to-blue-100">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $course->title }}</h3>
                <p class="text-gray-600 mb-3">{{ Str::limit($course->name, 100) }}</p>

                <p class="text-sm text-gray-500 mb-2">
    Tutor:
    @if($course->tutors->isNotEmpty())
        <span class="font-medium">
            {{ $course->tutors->first()->name }}
        </span>
    @else
        <span class="text-gray-400">No tutor assigned</span>
    @endif
</p>

                @if(in_array($course->id, $enrolledCourseIds))
                    <button class="w-full bg-green-500 text-white py-2 rounded-lg cursor-not-allowed">
                        ✅ Enrolled
                    </button>
                @else
                    <form action="{{ route('student.mycourses.enroll', ['course' => $course->id]) }}" method="POST">
    @csrf
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Enroll
    </button>
</form>

                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                            Enroll Now →
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
