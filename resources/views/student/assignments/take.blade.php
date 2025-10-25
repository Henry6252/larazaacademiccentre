@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $assessment->title }}</h2>
    <p class="text-gray-600 mb-6">{!! nl2br(e($assessment->description)) !!}</p>

    <form action="{{ route('student.assessments.submit', $assessment->id) }}" method="POST">
        @csrf

        @foreach($assessment->questions as $index => $question)
            <div class="mb-6 p-4 bg-gray-50 rounded-lg border">
                <p class="font-semibold mb-2">{{ $index + 1 }}. {{ $question->question_text }}</p>
                @foreach($question->options as $key => $option)
                    <label class="flex items-center mb-1 cursor-pointer">
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}"
                               class="mr-2 text-indigo-600 focus:ring-indigo-500" required>
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
        @endforeach

        <button type="submit"
            class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Submit Assessment
        </button>
    </form>

    <div class="mt-6">
        <a href="{{ route('student.assignments.unit', $assessment->course_unit_id) }}" 
           class="text-gray-600 hover:text-indigo-600 font-semibold">← Back to Unit</a>
    </div>
</div>
@endsection
