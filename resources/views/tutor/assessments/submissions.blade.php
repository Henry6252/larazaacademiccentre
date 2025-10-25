@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 shadow-md rounded-xl">
    <h2 class="text-2xl font-bold mb-6">Submissions for: {{ $assessment->title }}</h2>

    @if($assessment->description)
        <p class="text-gray-600 mb-4 whitespace-pre-line">{!! nl2br(e($assessment->description)) !!}</p>
    @endif

    @if(session('success'))
        <!-- Toast notification -->
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if($assessment->submissions->isEmpty())
        <p class="text-gray-600">No submissions yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full table-auto border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Student Name</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Grade</th>
                        <th class="px-4 py-2 border">Submitted At</th>
                        <th class="px-4 py-2 border">Answers</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assessment->submissions as $submission)
                        <tr class="hover:bg-gray-50 align-top">
                            <td class="px-4 py-2 border">{{ $submission->student->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $submission->student->email ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">
                                {{ $submission->grade !== null ? $submission->grade : 'Not graded' }}
                            </td>
                            <td class="px-4 py-2 border">{{ $submission->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 border">
                                <div class="whitespace-pre-line text-gray-700">
                                    {!! nl2br(e($submission->answers)) !!}
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <!-- Alpine.js modal trigger -->
                                <div x-data="{ open: false }" class="inline-block">
                                    <button @click="open = true"
                                        class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                                        Grade
                                    </button>

                                    <!-- Modal -->
                                    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                        <div @click.away="open = false" class="bg-white p-6 rounded-lg shadow-lg w-80">
                                            <h3 class="text-lg font-semibold mb-4">Grade {{ $submission->student->name }}</h3>

                                            <form action="{{ route('tutor.assessments.grade', $submission->id) }}" method="POST">
                                                @csrf
                                                <input type="number" name="grade" min="0" max="100" 
                                                    placeholder="Enter grade"
                                                    class="w-full border px-3 py-2 rounded mb-4 focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                                                    value="{{ $submission->grade ?? '' }}" required>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="open = false" 
                                                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                                                    <button type="submit" 
                                                        class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('tutor.assessments.unit', $assessment->course_unit_id) }}"
            class="text-gray-600 hover:text-indigo-600 font-semibold">
            ← Back to Unit Assessments
        </a>
    </div>
</div>
@endsection

@section('scripts')
<!-- Alpine.js for modals and toast notifications -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
