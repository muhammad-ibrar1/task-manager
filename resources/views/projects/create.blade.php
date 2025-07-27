@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create New Project</h2>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" name="name" class="form-control" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
