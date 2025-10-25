@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Grade Details</h1>

    <p><strong>Student:</strong> {{ $grade->student->name }}</p>
    <p><strong>Course:</strong> {{ $grade->course->name }}</p>
    <p><strong>Grade:</strong> {{ $grade->grade }}</p>

    <a href="{{ route('tutor.grades.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
</div>
@endsection
