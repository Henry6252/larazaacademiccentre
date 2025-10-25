@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">All Students’ Grades Overview</h2>
    <div class="flex justify-end mb-4 space-x-2">
    <a href="{{ route('admin.grades.export.excel') }}" class="bg-green-600 text-white px-4 py-2 rounded">Export Excel</a>
    <a href="{{ route('admin.grades.export.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded">Export PDF</a>
</div>


    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Student</th>
                <th>Course</th>
                <th>Unit</th>
                <th>Tutor</th>
                <th>Average</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $g)
                <tr class="border-t">
                    <td class="p-2">{{ $g->student_name }}</td>
                    <td>{{ $g->course_title }}</td>
                    <td>{{ $g->unit_name }}</td>
                    <td>{{ $g->tutor_name }}</td>
                    <td class="font-semibold text-center">{{ $g->average_score }}%</td>
                    <td>
                        <a href="{{ route('admin.grades.student', $g->student_id) }}" class="text-blue-500 underline">View Details</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-3">No grades found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
