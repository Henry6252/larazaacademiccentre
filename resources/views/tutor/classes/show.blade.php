@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $class->name }}</h1>
    <p><strong>Course:</strong> {{ $class->course->title ?? 'N/A' }}</p>
    <p><strong>Description:</strong> {{ $class->description ?? 'No description provided.' }}</p>

    <h4 class="mt-4">Enrolled Students</h4>
    <ul class="list-group">
        @forelse($class->students as $student)
            <li class="list-group-item">{{ $student->name }} ({{ $student->email }})</li>
        @empty
            <li class="list-group-item">No students enrolled yet.</li>
        @endforelse
    </ul>

    <div class="mt-4">
        <a href="{{ route('tutor.classes.edit', $class->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('tutor.classes.destroy', $class->id) }}" method="POST" style="display:inline-block">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this class?')">Delete</button>
        </form>

        <a href="{{ route('tutor.classes.index') }}" class="btn btn-secondary">Back to Classes</a>
    </div>
</div>
@endsection
