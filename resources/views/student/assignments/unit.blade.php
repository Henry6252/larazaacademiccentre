@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $unit->unit_name }} – Assessments</h2>

    @if($assessments->isEmpty())
        <p class="text-gray-600">No assessments available for this unit.</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach($assessments as $assessment)
                <li class="py-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold">{{ $assessment->title }}</h3>
                            <p class="text-gray-600">{{ $assessment->description }}</p>
                        </div>
                        <a href="{{ route('student.assessments.take', $assessment->id) }}" 
                           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Take Assessment
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-6">
        <a href="{{ route('student.assignments.index') }}" 
           class="text-gray-600 hover:text-indigo-600 font-semibold">← Back to Courses</a>
    </div>
</div>
@endsection
