@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid-theme.min.css') }}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="jsGrid1"></div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@endsection


@push('js')
    <!-- jQuery -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jsGrid -->
    <script src="{{ asset('assets/admin/plugins/jsgrid/demos/db.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {

            $.ajax({
                url: "{{ route('admin.users.profile') }}",
                method: 'GET',
                success: function(response) {
                    $("#jsGrid1").jsGrid({
                        height: "100%",
                        width: "100%",
                        sorting: true,
                        paging: true,
                        data: response.users,
                        fields: [{
                                name: "first_name",
                                title: "First Name",
                                type: "text",
                                width: 150
                            },
                            {
                                name: "last_name",
                                title: "Last Name",
                                type: "text",
                                width: 100
                            },
                            {
                                name: "username",
                                title: "Username",
                                type: "text",
                                width: 200
                            },
                            {
                                name: "email",
                                title: "Email",
                                type: "text",
                                width: 200
                            },
                            {
                                name: "country_code",
                                title: "Country Code",
                                type: "text",
                                width: 100
                            },
                            {
                                name: "phone_number",
                                title: "Phone Number",
                                type: "text",
                                width: 150
                            },
                            {
                                name: "address_line_1",
                                title: "Address Line 1",
                                type: "text",
                                width: 200
                            },
                            {
                                name: "address_line_2",
                                title: "Address Line 2",
                                type: "text",
                                width: 200
                            },
                            {
                                name: "city",
                                title: "City",
                                type: "text",
                                width: 150
                            },
                            {
                                name: "state",
                                title: "State",
                                type: "text",
                                width: 100
                            },
                            {
                                name: "country",
                                title: "Country",
                                type: "text",
                                width: 100
                            },
                            {
                                name: "postal_code",
                                title: "Postal Code",
                                type: "text",
                                width: 100
                            }
                        ]
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
@endpush
