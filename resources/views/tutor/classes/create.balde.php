@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Class</h1>
    <p>Fill in the details to create a new class for your students.</p>

    <form action="{{ route('tutor.classes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Class Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Algebra 101" required>
        </div>

        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <select class="form-select" id="course" name="course_id" required>
                <option value="">-- Select Course --</option>
                {{-- Dynamically load courses --}}
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Class Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Briefly describe the class..."></textarea>
        </div>

        <button type="submit" class="btn btn-success">Create Class</button>
        <a href="{{ route('tutor.classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
