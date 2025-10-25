@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8">

    {{-- Header --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Upload Material</h1>

    {{-- Course + Unit Info --}}
    <div class="bg-gray-100 p-4 rounded-lg shadow mb-6">
        <p class="text-gray-800"><strong>Course:</strong> {{ $unit->course->name ?? 'N/A' }}</p>
        <p class="text-gray-800"><strong>Unit:</strong> {{ $unit->name ?? 'Untitled Unit' }}</p>
    </div>

    {{-- Existing Materials --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Uploaded Materials</h2>
        @if($unit->materials && $unit->materials->isNotEmpty())
            <ul class="space-y-3">
                @foreach($unit->materials as $material)
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded border border-gray-200 hover:bg-gray-100 transition">
                        <div>
                            <p class="font-medium text-gray-800">{{ $material->title }}</p>
                            <p class="text-sm text-gray-500">
                                Uploaded on {{ $material->created_at->format('d M Y') }}
                            </p>
                        </div>
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center gap-1">
                            📥 View
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No materials uploaded yet.</p>
        @endif
    </div>

    {{-- Upload Form --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Upload New Material</h2>
        <form action="{{ route('tutor.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title"
                       class="mt-1 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter material title" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">File</label>
                <input type="file" name="file"
                       class="mt-1 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
                <p class="text-xs text-gray-500 mt-1">Allowed formats: PDF, DOC, DOCX, PPT, PPTX</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description (optional)</label>
                <textarea name="description"
                          class="mt-1 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                          rows="3" placeholder="Add a short description..."></textarea>
            </div>

            <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                Upload
            </button>
        </form>
    </div>

</div>
@endsection
