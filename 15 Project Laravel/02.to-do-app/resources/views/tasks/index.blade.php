<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Application</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>To-Do Application</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Add New Task -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Enter a new task" required>
        <button type="submit">Add Task</button>
    </form>

    <!-- Task List -->
    <h2>Tasks</h2>
    <ul>
        @foreach ($tasks as $task)
            <li>
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="is_completed" value="1"
                           onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                </form>
                {{ $task->title }}
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: red;">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
