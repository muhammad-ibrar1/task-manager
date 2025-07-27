@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Project</h2>

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" name="name" value="{{ $project->name }}" class="form-control" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
