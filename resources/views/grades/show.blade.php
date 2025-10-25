@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grade Details</h2>
@endsection

@section('content')
<div class="bg-white p-6 rounded shadow-md">
    <p><strong>ID:</strong> {{ $grade->id }}</p>
    <p><strong>Student:</strong> {{ $grade->student->name ?? 'N/A' }}</p>
    <p><strong>Course:</strong> {{ $grade->course->title ?? 'N/A' }}</p>
    <p><strong>Grade:</strong> {{ $grade->grade }}</p>

    <div class="mt-4">
        <a href="{{ route('grades.edit', $grade) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('grades.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection
