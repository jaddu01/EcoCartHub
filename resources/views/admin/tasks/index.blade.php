{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .status-due {
            color: orange;
        }
        .status-pending {
            color: blue;
        }
        .status-overdue {
            color: red;
        }
        .status-canceled {
            color: gray;
        }
        .status-completed {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">User Tasks</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Priority Level</th>
                                    <th>Status</th>
                                    <th>User ID</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ Carbon\Carbon::parse($task->due_date)->toDateString() }}</td>
                                    <td>{{ $task->priority_level }}</td>
                                    <td class="status-{{ $task->status }}">{{ ucfirst($task->status) }}</td>
                                    <td>
                                        @foreach($task->users as $user)
                                            {{ $user->id }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('user.tasks.edit',$task->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('user.tasks.delete', $task->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-status {
            margin-right: 10px;
        }
        .status-due {
            color: orange;
        }
        .status-pending {
            color: blue;
        }
        .status-overdue {
            color: red;
        }
        .status-canceled {
            color: gray;
        }
        .status-completed {
            color: green;
        }
        /* Style for the button */
        .create-task-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .create-task-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Tasks Dashboard</h5>
                        <div>
                            <a href="{{ route('user.tasks') }}" class="btn btn-primary btn-status">All Tasks</a>
                            <a href="{{ route('user.tasks.status', 'upcoming') }}" class="btn btn-info btn-status">Upcoming Tasks</a>
                            <a href="{{ route('user.tasks.status', 'completed') }}" class="btn btn-success btn-status">Completed Tasks</a>
                            <a href="{{ route('user.tasks.status', 'overdue') }}" class="btn btn-danger btn-status">Overdue Tasks</a>
                            <a href="{{ route('user.tasks.status', 'pending') }}" class="btn btn-warning btn-status">Pending Tasks</a>
                            <a href="{{ route('user.tasks.status', 'canceled') }}" class="btn btn-secondary btn-status">Canceled Tasks</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th>Priority Level</th>
                                        <th>Status</th>
                                        <th>User ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ Carbon\Carbon::parse($task->due_date)->toDateString() }}</td>
                                        <td>{{ $task->priority_level }}</td>
                                        <td class="status-{{ $task->status }}">{{ ucfirst($task->status) }}</td>
                                        <td>
                                            @foreach($task->users as $user)
                                                {{ $user->id }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('user.tasks.edit',$task->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('user.tasks.delete', $task->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button to create a new task -->
    <div class="create-task-button">
        <a href="{{ route('user.create') }}" style="text-decoration: none; color: inherit;">+</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


