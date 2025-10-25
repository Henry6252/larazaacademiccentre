@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">{{ $unit->name ?? 'Untitled Unit' }}</h1>

    <p class="mb-6">{{ $unit->description ?? 'No description available.' }}</p>

    {{-- Upload Material Form --}}
    <form action="{{ route('tutor.units.materials.store', $unit->id) }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <div class="mb-2">
            <input type="text" name="title" placeholder="Material Title" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-2">
            <textarea name="description" placeholder="Description (optional)" class="w-full border p-2 rounded"></textarea>
        </div>
        <div class="mb-2">
            <input type="file" name="file" class="w-full" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Upload Material</button>
    </form>

    {{-- List Existing Materials --}}
    <h3 class="font-semibold mb-2">Uploaded Materials:</h3>
    @if($unit->materials->isNotEmpty())
        <ul class="space-y-2">
            @foreach($unit->materials as $mat)
                <li class="bg-gray-50 p-3 rounded flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{ $mat->title }}</p>
                        <p class="text-xs text-gray-500">{{ $mat->created_at->format('d M Y') }}</p>
                    </div>
                    <a href="{{ asset('storage/' . $mat->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">📥 View</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No materials uploaded yet.</p>
    @endif
</div>
@endsection
