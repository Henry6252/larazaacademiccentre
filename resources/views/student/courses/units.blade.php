@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white rounded-2xl p-8 shadow-lg">
    <h2 class="text-3xl font-bold text-blue-700 mb-6">
        📘 Units for {{ $course->name }}
    </h2>

    @if($course->units->isEmpty())
        <div class="text-gray-600 text-center py-10">
            No units available for this course yet.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($course->units as $unit)
                <a href="{{ route('student.units.show', $unit->id) }}" class="block border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition no-underline">
                    <h3 class="text-xl font-semibold text-blue-600">
                        {{ $unit->name ?? 'Untitled Unit' }}
                    </h3>
                    <p class="text-gray-600 mt-2">
                        {{ $unit->description ?? 'No description provided.' }}
                    </p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
