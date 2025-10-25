@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-3xl font-bold text-blue-700 mb-6 flex items-center gap-2">
        📘 Course Management
    </h2>

    {{-- Success / Info Messages --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Course Creation Form --}}
    <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">➕ Create New Course</h3>

        <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Course Code</label>
                    <input type="text" name="code" value="{{ old('code') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. CSC101" required>
                    @error('code')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Course Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. Introduction to Programming" required>
                    @error('name')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Description (optional)</label>
                <textarea name="description" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Brief description of the course">{{ old('description') }}</textarea>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
                    Create Course
                </button>
            </div>
        </form>
    </div>

    {{-- Existing Courses List --}}
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">📚 Existing Courses</h3>

        @if($courses->isEmpty())
            <p class="text-gray-600">No courses available yet.</p>
        @else
            <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700 text-left">
                            <th class="px-4 py-3 font-semibold">Course Code</th>
                            <th class="px-4 py-3 font-semibold">Course Name</th>
                            <th class="px-4 py-3 font-semibold">Description</th>
                            <th class="px-4 py-3 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($courses as $course)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $course->code }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $course->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ Str::limit($course->description, 60) }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.courses.units.create', $course->id) }}"
                                        class="inline-block text-blue-600 hover:text-blue-800 font-semibold">
                                        ➕ Add Units
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
