@extends('layouts.app')

@section('title', 'My Classes')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">📝 My Classes</h1>

    <div class="bg-white shadow rounded-lg p-6">
        @if($classes->isEmpty())
            <p class="text-gray-600">No classes assigned yet.</p>
        @else
            <table class="min-w-full border border-gray-200 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">#</th>
                        <th class="px-4 py-2 border text-left">Class Name</th>
                        <th class="px-4 py-2 border text-left">Course</th>
                        <th class="px-4 py-2 border text-left">Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                        <tr>
                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border">{{ $class->name }}</td>
                            <td class="px-4 py-2 border">{{ $class->course->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $class->semester }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
