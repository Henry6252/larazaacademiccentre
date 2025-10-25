@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">My Units (Grades Overview)</h2>

    @forelse($units as $unit)
        <div class="p-4 border rounded mb-3 flex justify-between">
            <div>
                <h3 class="font-semibold text-lg">{{ $unit->name }}</h3>
                <p class="text-gray-500">{{ $unit->course->title }}</p>
            </div>
            <a href="{{ route('tutor.grades.unit', $unit->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">View Grades</a>
        </div>
    @empty
        <p>No units assigned.</p>
    @endforelse
</div>
@endsection
