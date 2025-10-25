@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 shadow-md rounded-xl">
    <h2 class="text-2xl font-bold mb-6">Units for {{ $course->name }}</h2>

    <a href="{{ route('admin.courses.units.create', $course->id) }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Unit</a>

    @if($units->isEmpty())
        <p class="text-gray-600 mt-4">No units added yet.</p>
    @else
        <table class="w-full border border-gray-200 mt-4">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Description</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td class="p-2 border">{{ $unit->name }}</td>
                        <td class="p-2 border">{{ $unit->description }}</td>
                        <td class="p-2 border space-x-2">
                            <a href="{{ route('admin.courses.units.edit', [$course->id, $unit->id]) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>
                            <form action="{{ route('admin.courses.units.destroy', [$course->id, $unit->id]) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
