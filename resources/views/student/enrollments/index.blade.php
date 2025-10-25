@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white rounded-2xl p-8 shadow-lg">
    <h2 class="text-3xl font-bold text-blue-700 mb-6 flex items-center gap-2">
        🎓 My Enrollments
    </h2>

    @if($enrollments->isEmpty())
        <div class="text-gray-600 text-center py-6">
            You haven’t enrolled in any course yet.
        </div>
    @else
        <div class="space-y-8">
            @foreach($enrollments as $enrollment)
                @php
                    $course = $enrollment->course;
                    $tutorName = $course->tutors->first()->name ?? 'No Tutor Assigned';
                @endphp

                {{-- Each enrolled course card --}}
                <div 
                    x-data="{ open: false }" 
                    class="border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-150"
                >
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            {{-- Course name is now clickable --}}
                            <h3 class="text-xl font-semibold text-gray-800">
                                <a href="{{ route('student.courses.units', $course->id) }}" 
                                   class="text-blue-700 hover:underline hover:text-blue-900 transition">
                                    {{ $course->name }}
                                </a>
                            </h3>

                            <p class="text-sm text-gray-600">
                                👨‍🏫 Tutor: 
                                <span class="font-medium text-blue-700">{{ $tutorName }}</span>
                            </p>
                            <p class="text-xs text-gray-500">
                                Enrolled on {{ $enrollment->created_at->format('d M, Y') }}
                            </p>
                        </div>

                        {{-- Optional collapsible section toggle --}}
                        <button 
                            @click="open = !open" 
                            class="flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium"
                        >
                            <span x-text="open ? 'Hide Details ▲' : 'Quick View ▼'"></span>
                        </button>
                    </div>

                    {{-- Collapsible quick view (optional) --}}
                    <div 
                        x-show="open" 
                        x-transition 
                        class="mt-4 border-t border-gray-100 pt-3 space-y-2"
                    >
                        @if($course->description)
                            <p class="text-gray-700 text-sm">{{ $course->description }}</p>
                        @else
                            <p class="text-gray-500 italic text-sm">No description available for this course.</p>
                        @endif

                        <div class="mt-2">
                            <a href="{{ route('student.courses.units', $course->id) }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg shadow">
                                📚 View Course Units
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Include Alpine.js if not already loaded --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
