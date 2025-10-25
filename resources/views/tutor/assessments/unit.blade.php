@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow p-6 rounded-lg">
    <h2 class="text-xl font-bold mb-3">Assessments for {{ $unit->name }}</h2>

    <a href="{{ route('tutor.assessments.create', $unit->id) }}" class="bg-green-600 text-white px-3 py-2 rounded">Create Assessment</a>

    <table class="mt-4 w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Title</th>
                <th>Type</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($assessments as $a)
            <tr class="border-t">
                <td class="p-2">{{ $a->title }}</td>
                <td>{{ $a->type }}</td>
                <td>{{ $a->due_date ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('tutor.assessments.submissions', $a->id) }}" class="text-blue-500 underline">View Submissions</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center py-2">No assessments yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
