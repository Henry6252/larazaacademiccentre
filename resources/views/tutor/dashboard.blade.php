@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">📖 Welcome to Tutor Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-bold text-xl mb-2">My Courses</h2>
            <p class="text-gray-600">View courses assigned to you by the admin.</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-bold text-xl mb-2">My Classes</h2>
            <p class="text-gray-600">Check your classes and schedules.</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-bold text-xl mb-2">Upload Materials</h2>
            <p class="text-gray-600">Upload course materials for your students.</p>
        </div>
    </div>
</div>
@endsection
