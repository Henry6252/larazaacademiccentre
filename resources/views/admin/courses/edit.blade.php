@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Course</h1>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-gray-700 font-medium">Course Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $course->name) }}"
                   required
                   class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="code" class="block text-gray-700 font-medium">Course Code</label>
            <input type="text" name="code" id="code"
                   value="{{ old('code', $course->code) }}"
                   required
                   class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="credits" class="block text-gray-700 font-medium">Credits</label>
            <input type="number" name="credits" id="credits"
                   value="{{ old('credits', $course->credits) }}"
                   min="1" required
                   class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-medium">Description (optional)</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description', $course->description) }}</textarea>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                Update Course
            </button>
            <a href="{{ route('admin.courses.index') }}"
               class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg shadow hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
