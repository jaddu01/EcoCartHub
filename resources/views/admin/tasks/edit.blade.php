<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
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
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Update Task</h5>
                    </div>
                    <div class="card-body">
                        <form id="taskForm" method="POST" action="{{ route('user.tasks.update',$task->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{ old('title',$task->title) }}" class="form-control" id="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter description">{{ old('description',$task->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <input type="date" name="due_date" value="{{ old('due_date', Carbon\Carbon::parse($task->due_date)->toDateString()) }}" class="form-control" id="due_date">
                            </div>
                            <div class="form-group">
                                <label for="priority_level">Priority Level (1-8)</label>
                                <input type="number" name="priority_level" value="{{ old('priority_level',$task->priority_level) }}" class="form-control" id="priority_level" min="1" max="8">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="pending">Pending</option>
                                    <option value="due">Due</option>
                                    <option value="overdue">Overdue</option>
                                    <option value="canceled">Canceled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(function () {
            $('#taskForm').validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 255
                    },
                    description: {
                        required: true,
                        maxlength: 1000
                    },
                    due_date: {
                        required: true
                    },
                    priority_level: {
                        required: true,
                        min: 1,
                        max: 8,
                        digits: true
                    },
                    status: {
                        required: true
                    }

                },
                messages: {
                    title: {
                        required: "Please enter the title",
                        maxlength: "The title cannot exceed 255 characters"
                    },
                    description: {
                        required: "Please enter the description",
                        maxlength: "The description cannot exceed 1000 characters"
                    },
                    due_date: {
                        required: "Please select the due date"
                    },
                    priority_level: {
                        required: "Please enter the priority level",
                        min: "Priority level must be at least 1",
                        max: "Priority level must be at most 8",
                        digits: "Priority level must be a number"
                    },
                    status: {
                        required: "Please select the status"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>
</html>
