@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow-md rounded-xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Create New Assessment for: {{ $unit->unit_name ?? 'Unit '.$unit->id }}
    </h2>

    <form action="{{ route('tutor.assessments.store') }}" method="POST">
        @csrf

        <input type="hidden" name="course_unit_id" value="{{ $unit->id }}">

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Assessment Title</label>
            <input type="text" name="title" id="title"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                placeholder="Enter assessment title" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                placeholder="Optional description or instructions"></textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="total_marks" class="block text-gray-700 font-semibold mb-2">Total Marks</label>
            <input type="number" name="total_marks" id="total_marks"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                min="1" placeholder="Enter total marks" required>
            @error('total_marks')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
    <input type="date" name="due_date" id="due_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
</div>


        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('tutor.assessments.unit', $unit->id) }}"
                class="text-gray-600 hover:text-indigo-600 font-semibold">
                ← Back to Unit Assessments
            </a>
            <button type="submit"
                class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">
                Create Assessment
            </button>
        </div>
    </form>
</div>
@endsection
