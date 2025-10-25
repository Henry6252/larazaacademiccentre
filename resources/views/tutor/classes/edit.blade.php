@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Class</h1>
    <p>Update the details for <strong>{{ $class->name }}</strong>.</p>

    <form action="{{ route('tutor.classes.update', $class->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Class Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $class->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <select class="form-select" id="course" name="course_id" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}"
                        {{ $course->id == $class->course_id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Class Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $class->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Class</button>
        <a href="{{ route('tutor.classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
