@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Grades for {{ $student->name }}</h2>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Course</th>
                <th>Unit</th>
                <th>Tutor</th>
                <th>Average Score</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $g)
                <tr class="border-t">
                    <td class="p-2">{{ $g->course_title }}</td>
                    <td>{{ $g->unit_name }}</td>
                    <td>{{ $g->tutor_name }}</td>
                    <td class="font-semibold text-center">{{ $g->average_score }}%</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-3">No grades recorded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
