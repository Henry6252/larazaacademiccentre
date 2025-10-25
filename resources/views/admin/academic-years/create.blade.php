@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Add Academic Year</h1>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.academic-years.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700 font-medium mb-1">Academic Year</label>
            <input type="text" name="year" value="{{ old('year') }}" class="w-full border-gray-300 rounded-md p-2" placeholder="e.g., 2025/2026">
        </div>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-500 transition">Add Year</button>
    </form>
</div>
@endsection
