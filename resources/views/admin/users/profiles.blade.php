@extends('admin.layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/admin/dist/img/user4-128x128.jpg')}}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone number</b> <a class="float-right">{{ $user->country_code }}{{ $user->phone_number }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Member Since</b> <a class="float-right">{{ $user->email_verified_at }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Address</strong>

                            <p class="text-muted">
                                Address Line 1: {{ $address->address_line_1 }} <br>
                                Address Line 2: {{ $address->address_line_2 }} <br>
                                City: {{ $address->city }} <br>
                                State: {{ $address->state }} <br>
                                Country: {{ $address->country }} <br>
                                Postal Code: {{ $address->postal_code }}
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
