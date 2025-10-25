@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 shadow-md rounded-xl">
    <h2 class="text-2xl font-bold mb-6">Add Unit for {{ $course->name }}</h2>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>

        <!-- Back to Units List Button -->
        <a href="{{ route('admin.courses.units.index', $course->id) }}"
           class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition mb-6">
            Back to Units List
        </a>
    @endif

    <form action="{{ route('admin.courses.units.store', $course->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Unit Name:</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="code" class="block text-gray-700 font-bold mb-2">Unit Code:</label>
            <input type="text" name="code" id="code" class="w-full border rounded p-2" value="{{ old('code') }}">
            @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
            <textarea name="description" id="description" class="w-full border rounded p-2">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Add Unit
        </button>
    </form>
</div>
@endsection
