@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Add Semester</h1>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.semesters.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700 font-medium mb-1">Semester Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-md p-2" placeholder="e.g., Fall">
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Academic Year</label>
            <select name="academic_year_id" class="w-full border-gray-300 rounded-md p-2">
                @foreach($academicYears as $year)
                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 transition">Add Semester</button>
    </form>
</div>
@endsection
