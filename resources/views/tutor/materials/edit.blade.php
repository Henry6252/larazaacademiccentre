@extends('layouts.app')

@section('title', 'Edit Material')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Material</h1>

    <form action="{{ route('tutor.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Title</label>
            <input type="text" name="title" class="border p-2 w-full rounded" value="{{ $material->title }}" required>
        </div>

        <div>
            <label class="block font-medium">Course</label>
            <select name="course_id" class="border p-2 w-full rounded" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" @if($material->course_id == $course->id) selected @endif>{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">File (Leave empty to keep existing)</label>
            <input type="file" name="file" class="border p-2 w-full rounded">
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
    </form>
</div>
@endsection
