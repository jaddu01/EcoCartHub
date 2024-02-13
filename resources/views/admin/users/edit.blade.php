@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Update User</li>
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
                            <h3 class="card-title">Update User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="userForm" name="userForm" method="Post"
                            action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name='first_name'
                                        value='{{ old('first_name', $user->first_name) }}' class="form-control"
                                        id="firstname" placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name='last_name' value='{{ old('last_name', $user->last_name) }}'
                                        class="form-control" id="lastname" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" name='username' value='{{ old('username', $user->username) }}'
                                        class="form-control" id="username" placeholder="Enter User Name">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name='email' value='{{ old('email', $user->email) }}'
                                        class="form-control" id="email" placeholder="Enter Email">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name='password' value='{{ old('password', $user->password )}}'
                                        class="form-control" id="password" placeholder="Enter Password">
                                </div>

                                <div class="form-group">
                                    <label for="countrycode">Country Code</label>
                                    <select name="country_code" class="form-control" id="countrycode">
                                        <option value="">Select Country Code</option>
                                        <option value="+1"
                                            {{ old('country_code', $user->country_code) == '+1' ? 'selected' : '' }}>United
                                            States (+1)</option>
                                        <option value="+44"
                                            {{ old('country_code', $user->country_code) == '+44' ? 'selected' : '' }}>United
                                            Kingdom (+44)</option>
                                        <option value="+91"
                                            {{ old('country_code', $user->country_code) == '+91' ? 'selected' : '' }}>India
                                            (+91)</option>
                                        <option value="+61"
                                            {{ old('country_code', $user->country_code) == '+61' ? 'selected' : '' }}>
                                            Australia (+61)</option>
                                        <option value="+86"
                                            {{ old('country_code', $user->country_code) == '+86' ? 'selected' : '' }}>China
                                            (+86)</option>
                                        <option value="+33"
                                            {{ old('country_code', $user->country_code) == '+33' ? 'selected' : '' }}>
                                            France (+33)</option>
                                        <option value="+49"
                                            {{ old('country_code', $user->country_code) == '+49' ? 'selected' : '' }}>
                                            Germany (+49)</option>
                                        <option value="+81"
                                            {{ old('country_code', $user->country_code) == '+81' ? 'selected' : '' }}>Japan
                                            (+81)</option>
                                        <option value="+52"
                                            {{ old('country_code', $user->country_code) == '+52' ? 'selected' : '' }}>
                                            Mexico (+52)</option>
                                        <option value="+7"
                                            {{ old('country_code', $user->country_code) == '+7' ? 'selected' : '' }}>Russia
                                            (+7)</option>
                                        <option value="+27"
                                            {{ old('country_code', $user->country_code) == '+27' ? 'selected' : '' }}>South
                                            Africa (+27)</option>
                                        <option value="+82"
                                            {{ old('country_code', $user->country_code) == '+82' ? 'selected' : '' }}>South
                                            Korea (+82)</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">Phone Number</label>
                                    <input type="text" name='phone_number' value='{{ old('phone_number',$user->phone_number) }}'
                                        class="form-control" id="phonenumber" placeholder="Enter phone number">
                                </div>
                                <div class="form-group">
                                    <label for="address_line_1">Address Line 1</label>
                                    <input type="text" name='address_line_1' value='{{ old('address_line_1') }}'
                                        class="form-control" id="address_line_1" placeholder="Enter Address Line 1">
                                </div>
                                <div class="form-group">
                                    <label for="address_line_2">Address Line 2</label>
                                    <input type="text" name='address_line_2' value='{{ old('address_line_2') }}'
                                        class="form-control" id="address_line_2" placeholder="Enter Address Line 2">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name='state' value='{{ old('state') }}'
                                        class="form-control" id="state" placeholder="Enter State">
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name='country' value='{{ old('country') }}'
                                        class="form-control" id="country" placeholder="Enter Country">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name='city' value='{{ old('city') }}'
                                        class="form-control" id="city" placeholder="Enter City">
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" name='postal_code' value='{{ old('postal_code') }}'
                                        class="form-control" id="postal_code" placeholder="Enter Postal Code">
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
    <script>
        $(function() {
            $('#userForm').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    country_code: {
                        required: true
                    },
                    phone_number: {
                        required: true
                    },
                    address_line_1: {
                        required: true
                    },
                    address_line_2: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    postal_code: {
                        required: true
                    },
                },
                messages: {
                    first_name: {
                        required: "Please enter first name",
                    },
                    last_name: {
                        required: "Please enter last name",
                    },
                    username: {
                        required: "Please enter username",
                    },
                    email: {
                        required: "Please enter quantity",
                    },
                    password: {
                        required: "Please enter password",
                    },
                    country_code: {
                        required: "Please select a country code"
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
    </script>
@endpush
