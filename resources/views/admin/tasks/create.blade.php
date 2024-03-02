{{-- @extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.tasks') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Task</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Task</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="taskForm" name="taskForm" method="Post" action="{{ route('user.tasks.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title"> Title </label>
                                    <input type="text" name='title' value='{{ old('task') }}' class="form-control"
                                        id="title" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="descrption"> Description </label>
                                    <input type="text" name='description' value='{{ old('description') }}'
                                        class="form-control" id="description" placeholder="Enter Description">
                                </div>
                                <div class="form-group">
                                    <label> Due Date </label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="due_date"
                                            value='{{ old('due_date') }}'class="form-control datetimepicker-input"
                                            data-target="#reservationdate" id="due_date" placeholder="Enter Due Date" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="periority_level">Periority Level</label>
                                    <input type="number" name='periority_level' value='{{ old('periority_level') }}'
                                        class="form-control" id="periority_level" placeholder="Enter Periority Level">
                                </div>

                                <div class="form-group">
                                    <label for="countrycode">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="">Select Status</option>
                                        <option value="pending"></option>
                                        <option value="due"></option>
                                        <option value="overdue"></option>
                                        <option value="cancled"></option>
                                        <option value="completed"></option>

                                    </select>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="user_id"> User ID </label>
                                        <input type="number" name='user_id' value='{{ old('user_id') }}'
                                            class="form-control" id="user_id" placeholder="Enter user_id">
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(function() {
            $('#taskForm').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    due_date: {
                        required: true,
                    },
                    periority_level: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    user_id: {
                        required: true,
                    },

                },
                messages: {
                    title: {
                        required: "Please enter title",
                    },
                    description: {
                        required: "Please enter description",
                    },
                    due_date: {
                        required: "Please enter due date",
                    },
                    periority_level: {
                        required: "Please enter periority level",
                    },
                    status: {
                        required: "Please enter status",
                    },
                    user_id: {
                        required: "Please enter user id"
                    },
                    phone_number: {
                        required: "Please select phone number"
                    },
                    address_line_1: {
                        required: "Please enter address line 1"
                    },
                    address_line_2: {
                        required: "Please enter address line 2"
                    },
                    city: {
                        required: "Please enter city"
                    },
                    state: {
                        required: "Please enter state"
                    },
                    country: {
                        required: "Please enter country"
                    },
                    postal_code: {
                        required: "Please enter postal code"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    </script>
@endpush --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
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
                        <h5 class="mb-0">Create Task</h5>
                    </div>
                    <div class="card-body">
                        <form id="taskForm" method="POST" action="{{ route('user.tasks.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control" id="due_date">
                            </div>
                            <div class="form-group">
                                <label for="priority_level">Priority Level (1-8)</label>
                                <input type="number" name="priority_level" value="{{ old('priority_level') }}" class="form-control" id="priority_level" min="1" max="8">
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
                            <div class="form-group">
                                <label for="priority_level">User ID</label>
                                <input type="number" name="user_id" value="{{ old('user_id') }}" class="form-control" id="user_id">
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
                    },
                    user_id:{
                        requried: true
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

