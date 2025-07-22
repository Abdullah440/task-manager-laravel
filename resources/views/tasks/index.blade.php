
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.min.css') }}">


    <style>
        .task-card[data-status="todo"]{
            border-left: 5px solid #ffc107;
        }
        .task-card[data-status="in_progress"]{
            border-left: 5px solid #0d6efd;
        }
        .task-card[data-status="done"]{
            border-left: 5px solid #198754;
        }
    </style>
</head>
<body class="bg-light p-3">
    <div class="container">
        <h2 class="mb-4">Task Manager</h2>

        <form method="POST" action="{{ route('tasks.store') }}" class="row g-3 mb-4">
            @csrf
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="Task title" required>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="todo">To Do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            {{-- description --}}
            <div class="col-md-4">
                <input type="text" name="description" class="form-control" placeholder="Task description (optional)">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary float-end">Add Task</button>
            </div>
        </form>

        <ul id="task-list" class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center task-card"
                    id="task-{{ $task->id }}"
                    data-id="{{ $task->id }}"
                    data-status="{{ $task->status }}">

                    <div>
                        <strong>{{ $task->title }}</strong>
                        <select class="form-select form-select-sm mt-2 status-select" data-id="{{ $task->id }}">
                            <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>

                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach

        </ul>
    </div>

    <script src={{asset("js/jquery.min.js")}}></script>
    <script src={{asset("js/sortable.min.js")}}></script>
    <script>
    $(document).ready(function () {
        let el = document.getElementById('task-list');
        new Sortable(el, {
            animation: 150,
            onEnd: function (evt) {
                let order = Array.from(el.children).map(item => item.dataset.id);
                fetch('/tasks/update-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order })
                });
            }
        });

        $('.status-select').change(function () {
            let taskId = $(this).data('id');
            let newStatus = $(this).val();
            let $taskItem = $('#task-' + taskId);

            $.ajax({
                url: '/tasks/' + taskId,
                type: 'PUT',
                data: {
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Update border color
                    $taskItem.attr('data-status', newStatus);

                    if (newStatus === 'todo') {
                        $taskItem.css('border-left', '5px solid #ffc107');
                    } else if (newStatus === 'in_progress') {
                        $taskItem.css('border-left', '5px solid #0d6efd');
                    } else if (newStatus === 'done') {
                        $taskItem.css('border-left', '5px solid #198754');
                    }
                },
                error: function () {
                    alert('Failed to update task status.');
                }
            });
        });
    });
    </script>
</body>
</html>
