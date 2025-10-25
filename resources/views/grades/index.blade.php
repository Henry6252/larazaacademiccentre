@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grades</h2>
@endsection

@section('content')
<div class="mb-4">
    <a href="{{ route('grades.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Add Grade</a>
</div>

<table class="w-full border-collapse bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Student</th>
            <th class="border px-4 py-2">Course</th>
            <th class="border px-4 py-2">Grade</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
        <tr>
            <td class="border px-4 py-2">{{ $grade->id }}</td>
            <td class="border px-4 py-2">{{ $grade->student->name ?? 'N/A' }}</td>
            <td class="border px-4 py-2">{{ $grade->course->title ?? 'N/A' }}</td>
            <td class="border px-4 py-2">{{ $grade->grade }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('grades.show', $grade) }}" class="text-blue-600">View</a> |
                <a href="{{ route('grades.edit', $grade) }}" class="text-green-600">Edit</a> |
                <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600" onclick="return confirm('Delete grade?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
