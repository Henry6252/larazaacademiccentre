@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6 text-indigo-700">📚 Units for {{ $course->name }}</h2>

    @foreach($units as $unit)
        <div class="mb-6 bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $unit->name }} ({{ $unit->code }})</h3>
            <p class="text-gray-600 mb-4">{{ $unit->description }}</p>

            {{-- Uploaded Materials --}}
            <div class="mb-4">
                <h4 class="font-semibold text-gray-700 mb-2">Uploaded Materials:</h4>
                @forelse($unit->materials as $material)
                    <a href="{{ asset('storage/'.$material->file_path) }}" target="_blank"
                       class="block text-indigo-600 hover:text-indigo-800 transition">
                        📄 {{ $material->title }}
                    </a>
                @empty
                    <p class="text-gray-400 italic">No materials uploaded yet.</p>
                @endforelse
            </div>

            {{-- ✅ Upload Material Button (links to create route) --}}
            <div class="mb-4">
                <a href="{{ route('tutor.materials.create', $unit->id) }}"
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Upload Material
                </a>
            </div>

            {{-- ✅ Inline Upload Form (kept, but fixed to use new route) --}}
            <form 
                action="{{ route('tutor.materials.store') }}" 
                method="POST" 
                enctype="multipart/form-data"
                class="border-t border-gray-200 pt-4 mt-4"
            >
                @csrf

                <h2 class="text-lg font-semibold text-gray-800 mb-3">Upload New Material</h2>

                {{-- Hidden unit_id (required by database) --}}
                <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                {{-- Material Title --}}
                <div class="mb-3">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        placeholder="Enter material title" 
                        class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-indigo-400 focus:outline-none" 
                        required
                    >
                </div>

                {{-- Description (optional) --}}
                <div class="mb-3">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="3"
                        placeholder="Enter a short description..."
                        class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    ></textarea>
                </div>

                {{-- File Upload --}}
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Upload File</label>
                    <input 
                        type="file" 
                        id="file" 
                        name="file" 
                        class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-indigo-400 focus:outline-none" 
                        required
                    >
                    <p class="text-xs text-gray-500 mt-1">Allowed types: PDF, DOC, DOCX, PPT, PPTX, ZIP (max 10MB)</p>
                </div>

                {{-- Submit Button --}}
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition"
                >
                    Upload Material
                </button>
            </form>

        </div>
    @endforeach
</div>
@endsection
