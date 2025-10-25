@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 p-8">
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-3xl p-8">
        <h1 class="text-3xl font-bold text-blue-700 mb-6">🎓 Welcome, {{ $student->name }}</h1>

        <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white p-6 rounded-2xl shadow">
                <h3 class="text-xl font-semibold">Courses</h3>
                <p class="text-3xl mt-2 font-bold">{{ $stats['total_courses'] }}</p>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white p-6 rounded-2xl shadow">
                <h3 class="text-xl font-semibold">Completed</h3>
                <p class="text-3xl mt-2 font-bold">{{ $stats['completed'] }}</p>
            </div>

            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-6 rounded-2xl shadow">
                <h3 class="text-xl font-semibold">GPA</h3>
                <p class="text-3xl mt-2 font-bold">{{ $stats['gpa'] }}</p>
            </div>

            <div class="bg-gradient-to-r from-pink-500 to-rose-500 text-white p-6 rounded-2xl shadow">
                <h3 class="text-xl font-semibold">Assignments Due</h3>
                <p class="text-3xl mt-2 font-bold">{{ $stats['pending_assignments'] }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
