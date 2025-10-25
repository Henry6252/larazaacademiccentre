@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Course</h1>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 border border-red-300">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                required>
        </div>

        <div>
            <label for="code" class="block text-sm font-medium text-gray-700">Course Code</label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                required>
        </div>

        <div>
            <label for="credits" class="block text-sm font-medium text-gray-700">Credits</label>
            <input type="number" name="credits" id="credits" value="{{ old('credits') }}" min="1"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description (optional)</label>
            <textarea name="description" id="description" rows="3" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" 
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Save Course
            </button>
            <a href="{{ route('admin.courses.index') }}" 
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
