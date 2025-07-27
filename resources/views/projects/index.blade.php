@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Projects</h2>

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">+ Add Project</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
