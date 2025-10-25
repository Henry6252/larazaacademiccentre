@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-3">
            📚 My Assigned Courses
        </h2>

        @if($courses->isEmpty())
            <div class="flex items-center justify-center py-10">
                <p class="text-gray-500 text-lg">No courses have been assigned to you yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                Course Code
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                Course Name
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                Semester
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($courses as $course)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $course->code }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $course->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $course->semester->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('tutor.courses.show', $course->id) }}" 
                                       class="px-3 py-1 text-xs font-semibold rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
                                        View
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('tutor.courses.edit', $course->id) }}" 
                                       class="px-3 py-1 text-xs font-semibold rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">
                                        Edit
                                    </a>

                                    <!-- Download Button -->
                                    <a href="{{ route('tutor.courses.download', $course->id) }}" 
                                       class="px-3 py-1 text-xs font-semibold rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition">
                                        Download
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
