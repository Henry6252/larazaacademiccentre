@extends('layouts.app')

@section('title', 'My Materials')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">📚 My Materials</h1>

    <div class="mb-4">
        <a href="{{ route('tutor.materials.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Upload New Material</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        @if($materials->isEmpty())
            <p class="text-gray-600">No materials uploaded yet.</p>
        @else
            <table class="min-w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Course</th>
                        <th class="px-4 py-2 border">Uploaded By</th>
                        <th class="px-4 py-2 border">File</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                        <tr>
                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border">{{ $material->title }}</td>
                            <td class="px-4 py-2 border">{{ $material->course->title ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $material->user->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ asset('storage/'.$material->file_path) }}" target="_blank" class="text-blue-500 hover:underline">Download</a>
                            </td>
                            <td class="px-4 py-2 border flex space-x-2">
                                <a href="{{ route('tutor.materials.show', $material->id) }}" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">View</a>
                                <a href="{{ route('tutor.materials.edit', $material->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('tutor.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Delete this material?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
