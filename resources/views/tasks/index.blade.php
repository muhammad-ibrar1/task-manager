@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h2 class="mb-4">Tasks</h2>

    <!-- Filter by Project -->
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
        <div class="input-group">
            <label class="input-group-text" for="project_id">Filter by Project</label>
            <select name="project_id" id="project_id" class="form-select" onchange="this.form.submit()">
                <option value="">All Projects</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Create Task -->
    <form action="{{ route('tasks.store') }}" method="POST" class="row g-2 mb-4">
        @csrf
        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Task name" required>
        </div>
        <div class="col-md-4">
            <select name="project_id" class="form-select">
                <option value="">Assign to Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary">Add Task</button>
        </div>
    </form>

    <!-- Task List -->
    <ul id="task-list" class="list-unstyled">
        @forelse($tasks as $task)
            <li class="task-item" data-id="{{ $task->id }}">
                <div class="d-flex justify-content-between align-items-center border p-2 mb-2 bg-light">
                    <div>
                        <strong>{{ $task->name }}</strong>
                        @if($task->project)
                            <small class="text-muted">({{ $task->project->name }})</small>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <!-- Edit -->
                        <form action="{{ route('tasks.update', $task) }}" method="POST" class="d-flex">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $task->name }}" class="form-control form-control-sm me-2" style="width: 140px;">
                            <button class="btn btn-sm btn-success">Update</button>
                        </form>
                        <!-- Delete -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </li>
        @empty
            <li class="text-muted">No tasks found.</li>
        @endforelse
    </ul>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function () {
        $('#task-list').sortable({
            update: function () {
                let order = [];
                $('#task-list .task-item').each(function () {
                    order.push($(this).data('id'));
                });

                $.post('{{ route('tasks.reorder') }}', {
                    _token: '{{ csrf_token() }}',
                    order: order
                });
            }
        });
    });
</script>
@endsection
