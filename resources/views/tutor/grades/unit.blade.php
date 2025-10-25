@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Grades for {{ $unit->name }}</h2>
    <div class="flex justify-end mb-4 space-x-2">
    <a href="{{ route('tutor.grades.export.excel', $unit->id) }}" class="bg-green-600 text-white px-4 py-2 rounded">Export Excel</a>
    <a href="{{ route('tutor.grades.export.pdf', $unit->id) }}" class="bg-red-600 text-white px-4 py-2 rounded">Export PDF</a>
</div>


    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Student Name</th>
                <th>Average Score</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $g)
                <tr class="border-t">
                    <td class="p-2">{{ $g->student_name }}</td>
                    <td class="text-center font-semibold">{{ $g->average_score }}%</td>
                </tr>
            @empty
                <tr><td colspan="2" class="text-center py-3">No graded submissions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
