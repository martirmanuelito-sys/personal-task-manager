<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #302f31;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button, .edit-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .add-btn {
            background: #333;
            color: white;
        }

        .edit-btn {
            background: #3498db;
            color: white;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
        }

        .task {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid blue;
            border-radius: 8px;
        }

        .task-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1><i>  Personal Task Manager </i> </h1>

    <!-- Add Task -->
    <form method="POST" action="/tasks">
        @csrf

        <div class="form-group">
            <label>Task Name</label>
            <input type="text" name="task_name" placeholder="Enter task name" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" placeholder="Enter task description"></textarea>
        </div>

        <div class="form-group">
            <label>Due Date</label>
            <input type="date" name="due_date">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="add-btn">Add Task</button>
    </form>

    <h2>My Tasks</h2>

    @foreach ($tasks as $task)

        <div class="task">

            <h3>{{ $task->task_name }}</h3>

            <p>
                <strong>Description:</strong>
                {{ $task->description }}
            </p>

            <p>
                <strong>Due Date:</strong>
                {{ $task->due_date }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $task->status }}
            </p>

            <!-- Edit and Delete -->
            <div class="task-actions">

                <a href="/tasks/{{ $task->id }}/edit" class="edit-btn">
                    Edit
                </a>

                <form method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this task?')">
                        Delete
                    </button>
                </form>

            </div>

        </div>

    @endforeach

</div>

</body>
</html>