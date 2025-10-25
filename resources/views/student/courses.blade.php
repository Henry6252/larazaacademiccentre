@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-green-600">Course Registration</h1>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabs -->
    <div class="mb-6 border-b border-gray-200" x-data="{ tab: 'all', filterSemester: '' }">
        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
            <button 
                @click="tab = 'all'" 
                :class="tab === 'all' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                All Courses
            </button>
            <button 
                @click="tab = 'registered'" 
                :class="tab === 'registered' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                My Registered Courses
            </button>
        </nav>

        <!-- Semester Filter -->
        <div x-show="tab === 'all'" class="mt-4 flex items-center space-x-4">
            <label class="text-gray-700 font-medium">Filter by Semester:</label>
            <select x-model="filterSemester" class="border-gray-300 rounded-md p-2">
                <option value="">All Semesters</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}">
                        {{ $semester->name }} ({{ $semester->academicYear->year ?? '' }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Courses Grid -->
        <div x-show="tab === 'all'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($courses as $course)
                @php
                    $isRegistered = auth()->user()->registeredCourses->contains($course->id);
                @endphp
                <div 
                    x-show="!filterSemester || filterSemester == '{{ $course->semester_id ?? '' }}'"
                    class="relative bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-xl transition transform hover:-translate-y-1 duration-200"
                >
                    <!-- Registered Badge -->
                    @if($isRegistered)
                        <span class="absolute top-2 right-2 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded-full">Registered</span>
                    @endif

                    <h2 class="text-xl font-semibold text-gray-800">{{ $course->name }}</h2>
                    <p class="text-gray-600 mt-2">Code: <span class="font-medium">{{ $course->code }}</span></p>
                    <p class="text-gray-600 mt-1">Credits: <span class="font-medium">{{ $course->credits ?? 'N/A' }}</span></p>

                    <!-- Registration Form -->
                    <form action="{{ route('student.courses.register') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <label class="block text-gray-700 font-medium mb-2">Select Semester</label>
                        <select name="semester_id" class="border-gray-300 rounded-md w-full p-2 mb-2" @if($isRegistered) disabled @endif>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}">
                                    {{ $semester->name }} ({{ $semester->academicYear->year ?? '' }})
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" 
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500 transition w-full @if($isRegistered) opacity-50 cursor-not-allowed @endif"
                            @if($isRegistered) disabled @endif>
                            {{ $isRegistered ? 'Already Registered' : 'Register' }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Registered Courses List -->
        <div x-show="tab === 'registered'" class="bg-white shadow rounded p-6 mt-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">My Registered Courses</h3>
            @if(auth()->user()->registeredCourses->count() > 0)
                <ul class="space-y-2">
                    @foreach(auth()->user()->registeredCourses as $course)
                        <li class="p-3 bg-gray-50 rounded flex justify-between items-center shadow-sm hover:shadow-md transition">
                            <div>
                                {{ $course->name }} ({{ $course->code }})
                            </div>
                            <div class="text-gray-600 text-sm">
                                Semester: {{ $course->pivot->semester->name ?? 'N/A' }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">You have not registered any courses yet.</p>
            @endif
        </div>
    </div>

</div>

<!-- AlpineJS for tabs and filtering -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
