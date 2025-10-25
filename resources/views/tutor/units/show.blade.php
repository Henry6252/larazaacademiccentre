@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8">
    {{-- Unit Title --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-4">
        {{ $unit->name ?? 'Untitled Unit' }}
    </h1>

    {{-- Unit Description --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
        <p class="text-gray-600">
            {{ $unit->description ?? 'No description available for this unit.' }}
        </p>
    </div>

    {{-- Existing Materials --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Existing Materials</h2>

        @if($unit->materials && $unit->materials->isNotEmpty())
            <div class="space-y-3">
                @foreach($unit->materials as $material)
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                        <div>
                            <p class="font-medium text-gray-800">{{ $material->title ?? 'Untitled Material' }}</p>
                            <p class="text-sm text-gray-500">
                                Uploaded: {{ $material->created_at ? $material->created_at->format('d M Y') : 'Date not available' }}
                            </p>
                            <p class="text-sm text-gray-400 break-all">
                                File path: {{ 'storage/' . $material->file_path }}
                            </p>
                        </div>
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                           📥 View
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No materials have been uploaded for this unit yet.</p>
        @endif
    </div>

    {{-- Upload New Material --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Upload New Material</h2>
        <form action="{{ route('tutor.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="2" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">File</label>
                <input type="file" name="file" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                Upload Material
            </button>
        </form>
    </div>

    {{-- Back Button --}}
    <div class="mt-6">
        <a href="{{ url()->previous() }}" 
           class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
           ← Back to Course
        </a>
    </div>
</div>
@endsection
