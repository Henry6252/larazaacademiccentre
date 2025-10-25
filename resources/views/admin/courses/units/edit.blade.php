@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 shadow-md rounded-xl">
    <h2 class="text-2xl font-bold mb-6">Edit Unit: {{ $unit->title }}</h2>

    <form action="{{ route('admin.courses.units.update', [$course->id, $unit->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Unit Title:</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-2" value="{{ old('title', $unit->title) }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
            <textarea name="description" id="description" class="w-full border rounded p-2">{{ old('description', $unit->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Unit</button>
    </form>
</div>
@endsection
