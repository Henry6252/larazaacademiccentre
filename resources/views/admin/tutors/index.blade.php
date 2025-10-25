@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tutors</h1>

        {{-- Removed or commented the broken Assign Courses header link --}}
        {{-- <a href="{{ route('admin.tutors.assign_courses.form', $tutor->id) }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500 transition">
           Assign Courses
        </a> --}}
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Courses</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($tutors as $tutor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $tutor->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $tutor->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            @if ($tutor->courseAssignments && $tutor->courseAssignments->count())
                                {{ $tutor->courseAssignments->map(function($c) { return $c->name; })->join(', ') }}
                            @else
                                <span class="text-gray-400">None</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                            <a href="{{ route('admin.tutors.assign_courses.form', $tutor->id) }}"
                               class="text-indigo-600 hover:text-indigo-900">
                               Assign Courses
                            </a>
                            <a href="{{ route('admin.tutors.edit', $tutor->id) }}"
                               class="text-blue-600 hover:text-blue-900">
                               Edit
                            </a>
                            <form action="{{ route('admin.tutors.destroy', $tutor->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure you want to delete this tutor?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No tutors found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tutors->links() }}
    </div>
</div>
@endsection
