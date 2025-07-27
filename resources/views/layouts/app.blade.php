<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery UI CSS (for sortable) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tasks.index') }}">Task Manager</a>
            <div>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary me-2">Tasks</a>
                <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">Projects</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Scripts (needed for drag-and-drop) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</body>
</html>
