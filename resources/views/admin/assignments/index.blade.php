@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Assignments</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Create Button --}}
    <div class="mb-3">
        <a href="{{ route('assignments.create') }}" class="btn btn-primary">+ Add Assignment</a>
    </div>

    {{-- Table --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Due Date</th>
                <th width="220px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->due_date }}</td>
                    <td>
                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No assignments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $assignments->links() !!}
    </div>
</div>
@endsection
