@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Assignment Details</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $assignment->title }}</h3>
            <p><strong>Description:</strong> {{ $assignment->description }}</p>
            <p><strong>Due Date:</strong> {{ $assignment->due_date }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">← Back to Assignments</a>
        <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</button>
        </form>
    </div>
</div>
@endsection
