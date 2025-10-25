@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white rounded-2xl shadow-lg p-8">
    {{-- Course Header --}}
    <div class="mb-6 border-b pb-4">
        <h1 class="text-3xl font-bold text-blue-700 mb-2">
            {{ $course->name }}
        </h1>
        <p class="text-gray-600">📘 Code: <strong>{{ $course->code ?? 'N/A' }}</strong></p>
    </div>

    {{-- Units Section --}}
    <h2 class="text-2xl font-semibold text-gray-800 border-l-4 border-blue-600 pl-3 mb-6">
        Course Units
    </h2>

    @if($course->units->isEmpty())
        <p class="text-gray-500 text-center italic py-8">No units have been created for this course yet.</p>
    @else
        <div class="space-y-6">
            @foreach($course->units as $unit)
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-150 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $unit->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $unit->description ?? 'No description.' }}</p>
                        </div>
                        <button @click="open = !open" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <span x-text="open ? 'Hide Upload ▲' : 'Upload Material ▼'"></span>
                        </button>
                    </div>

                    {{-- Upload Form --}}
                    <div x-show="open" x-transition class="mt-4 border-t border-gray-100 pt-3">
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


                        {{-- Existing Materials --}}
                        @if($unit->materials->isNotEmpty())
                            <div class="mt-4 border-t border-gray-200 pt-3 space-y-2">
                                <h4 class="font-semibold text-gray-800">Uploaded Materials:</h4>
                                @foreach($unit->materials as $mat)
                                    <div class="bg-gray-50 p-3 rounded-lg flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $mat->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $mat->created_at->format('d M Y') }}</p>
                                        </div>
                                        <a href="{{ asset('storage/' . $mat->file_path) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 text-sm">📥 View</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
