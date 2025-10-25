@extends('layouts.app')

@section('title', 'View Material')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ $material->title }}</h1>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        <p><strong>Course:</strong> {{ $material->course->title ?? 'N/A' }}</p>
        <p><strong>Uploaded By:</strong> {{ $material->user->name ?? 'Unknown' }}</p>
        <p><strong>File:</strong> 
            <a href="{{ asset('storage/'.$material->file_path) }}" target="_blank" class="text-blue-500 hover:underline">Download/View</a>
        </p>

        <a href="{{ route('tutor.materials.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection
