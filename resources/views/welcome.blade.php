<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
      <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    
                    <div class="panel-heading"><H1>Task Management<H1></div>

                    <div class="panel-body">
                        <!-- Task Creation Form -->
                        <form action="{{ route('tasks.store') }}" method="POST" class="form-inline">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter Task Name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </form>

                        <!-- Task List -->
                        <ul id="task-list" class="list-group mt-3">
                            @foreach($tasks as $task)
                                <li class="task list-group-item" data-task-id="{{ $task->id }}" >{{ $task->name }}
                                    <span class="pull-right">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                        </form>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Sortable(document.getElementById('task-list'), {
            animation: 150,
            onEnd: function (evt) {
                // Get the task IDs in the new order
                var taskIds = [];
                var taskElements = document.querySelectorAll('.task');
                taskElements.forEach(function (element) {
                    taskIds.push(element.dataset.taskId);
                });
    
                // Send AJAX request to update task order
                fetch('/reorder-tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ taskIds: taskIds })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to reorder tasks');
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Handle error
                });
            }
        });
    });
 </script>