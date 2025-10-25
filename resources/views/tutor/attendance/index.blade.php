@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Attendance Records</h1>

    <a href="{{ route('teacher.attendance.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + Record Attendance
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2">#</th>
                <th class="p-2">Student</th>
                <th class="p-2">Course</th>
                <th class="p-2">Date</th>
                <th class="p-2">Status</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr class="border-b">
                    <td class="p-2">{{ $attendance->id }}</td>
                    <td class="p-2">{{ $attendance->student->name }}</td>
                    <td class="p-2">{{ $attendance->course->title }}</td>
                    <td class="p-2">{{ $attendance->date }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded 
                            {{ $attendance->status == 'Present' ? 'bg-green-200 text-green-800' : 
                               ($attendance->status == 'Absent' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                            {{ $attendance->status }}
                        </span>
                    </td>
                    <td class="p-2">
                        <a href="{{ route('teacher.attendance.show', $attendance) }}" 
                           class="text-blue-600">View</a> |
                        <a href="{{ route('teacher.attendance.edit', $attendance) }}" 
                           class="text-yellow-600">Edit</a> |
                        <form action="{{ route('teacher.attendance.destroy', $attendance) }}" 
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600" 
                                onclick="return confirm('Delete this record?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="p-4 text-center">No records found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
</div>
@endsection
