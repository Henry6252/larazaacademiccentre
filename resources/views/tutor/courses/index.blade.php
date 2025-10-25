@extends('layouts.app')

@section('content')
{{-- ADMIN COURSES INDEX --}}

<div class="p-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Assigned Courses</h1>
        <span class="text-sm text-gray-500">Welcome, {{ auth()->user()->name }}</span>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Course Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Course Code
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Semester
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Academic Year
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($courses as $course)
                    <tr class="hover:bg-blue-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-blue-700 font-semibold">
                            <a href="{{ route('tutor.courses.show', $course->id) }}" 
                               class="hover:underline hover:text-blue-900 transition">
                                {{ $course->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $course->code ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $course->semester->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $course->academicYear->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <a href="{{ route('tutor.courses.show', $course->id) }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg text-sm transition">
                               View Units
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">
                            No courses assigned.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($courses, 'links'))
        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    @endif
</div>
@endsection
